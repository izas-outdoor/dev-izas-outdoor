<?php

namespace Omnisend\Omnisend\Model;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\Customer;
use Magento\Newsletter\Model\SubscriberFactory;
use Omnisend\Omnisend\Model\Attribute\IsImported\CustomerAttributeUpdater;
use Omnisend\Omnisend\Model\EntityDataSender\Customer as CustomerEntitySender;
use Psr\Log\LoggerInterface;

class CustomerEmailChangeHandler implements CustomerEmailChangeHandlerInterface
{
    /**
     * @var SubscriberFactory
     */
    private $subscriberFactory;

    /**
     * @var CustomerEntitySender
     */
    private $customerEntitySender;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CustomerAttributeUpdater
     */
    private $customerAttributeUpdater;

    /**
     * @var OmnisendContactProviderInterface
     */
    private $omnisendContactProvider;

    /**
     * @var UnsubscriptionServiceInterface
     */
    private $unsubscriptionService;

    /**
     * @param SubscriberFactory $subscriberFactory
     * @param CustomerEntitySender $customerEntitySender
     * @param LoggerInterface $logger
     * @param CustomerAttributeUpdater $customerAttributeUpdater
     * @param OmnisendContactProviderInterface $omnisendContactProvider
     * @param UnsubscriptionServiceInterface $unsubscriptionService
     */
    public function __construct(
        SubscriberFactory $subscriberFactory,
        CustomerEntitySender $customerEntitySender,
        LoggerInterface $logger,
        CustomerAttributeUpdater $customerAttributeUpdater,
        OmnisendContactProviderInterface $omnisendContactProvider,
        UnsubscriptionServiceInterface $unsubscriptionService
    ) {
        $this->subscriberFactory = $subscriberFactory;
        $this->customerEntitySender = $customerEntitySender;
        $this->logger = $logger;
        $this->customerAttributeUpdater = $customerAttributeUpdater;
        $this->omnisendContactProvider = $omnisendContactProvider;
        $this->unsubscriptionService = $unsubscriptionService;
    }

    /**
     * @param Customer|CustomerInterface $customer
     * @return null|string
     */
    public function handleEmailChange($customer)
    {
        if (!$customer instanceof Customer && !$customer instanceof CustomerInterface) {
            return null;
        }

        $customerId = $customer->getId();
        $contacts = $this->omnisendContactProvider->getOmnisendContactsByCustomerId($customerId);

        if (!count($contacts)) {
            return $this->postCustomerWithChangedEmail($customer);
        }

        $customerSubscription = $this->subscriberFactory->create()->loadByCustomerId($customerId);
        $subscriberId = $customerSubscription->getId();
        $guestSubscribers = $this->omnisendContactProvider->getOmnisendGuestSubscribersBySubscriberId($subscriberId);

        $wasSuccess = $this->unsubscriptionService->unsubscribeFromAllStores(
            $customerSubscription,
            $contacts,
            $guestSubscribers
        );

        if ($wasSuccess) {
            return $this->postCustomerWithChangedEmail($customer);
        }

        $this->customerAttributeUpdater->setEmailChangedFlag($customerId, 1);
        $this->logger->critical('Email change data synchronisation was not successful for customer - ' . $customerId);

        return null;
    }

    /**
     * @param Customer|CustomerInterface $customer
     * @return null|string
     */
    protected function postCustomerWithChangedEmail($customer)
    {
        $this->customerAttributeUpdater->setEmailChangedFlag($customer->getId(), 0);

        return $this->customerEntitySender->send($customer);
    }
}