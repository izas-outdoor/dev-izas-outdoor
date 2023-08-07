<?php

namespace Omnisend\Omnisend\Observer;

use Magento\Newsletter\Model\Subscriber as BaseSubscriber;
use Omnisend\Omnisend\Model\Attribute\IsImported\CustomerAttributeUpdater;
use Omnisend\Omnisend\Model\Attribute\IsImported\SubscriberAttributeUpdater;
use Omnisend\Omnisend\Model\Config\GeneralConfig;
use Omnisend\Omnisend\Model\ResponseRateManagerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Omnisend\Omnisend\Model\EntityDataSender\Subscriber as SubscriberDataSender;
use Omnisend\Omnisend\Model\Attribute\IsImported\ImportStatus;

class GuestSubscriberUpdateObserver implements ObserverInterface
{
    /**
     * @var ResponseRateManagerInterface
     */
    private $responseRateManager;

    /**
     * @var SubscriberDataSender
     */
    private $subscriberDataSender;

    /**
     * @var GeneralConfig
     */
    private $generalConfig;

    /**
     * @var ImportStatus
     */
    private $importStatus;

    /**
     * @var CustomerAttributeUpdater
     */
    private $customerAttributeUpdater;

    /**
     * @var SubscriberAttributeUpdater
     */
    private $subscriberAttributeUpdater;

    /**
     * @param ResponseRateManagerInterface $responseRateManager
     * @param SubscriberDataSender $subscriberDataSender
     * @param GeneralConfig $generalConfig
     * @param ImportStatus $importStatus
     * @param CustomerAttributeUpdater $customerAttributeUpdater
     * @param SubscriberAttributeUpdater $subscriberAttributeUpdater
     */
    public function __construct(
        ResponseRateManagerInterface $responseRateManager,
        SubscriberDataSender $subscriberDataSender,
        GeneralConfig $generalConfig,
        ImportStatus $importStatus,
        CustomerAttributeUpdater $customerAttributeUpdater,
        SubscriberAttributeUpdater $subscriberAttributeUpdater
    ) {
        $this->responseRateManager = $responseRateManager;
        $this->subscriberDataSender = $subscriberDataSender;
        $this->generalConfig = $generalConfig;
        $this->importStatus = $importStatus;
        $this->customerAttributeUpdater = $customerAttributeUpdater;
        $this->subscriberAttributeUpdater = $subscriberAttributeUpdater;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $subscriber = $observer->getEvent()->getSubscriber();
        $subscriberId = $subscriber->getSubscriberId();

        if ($subscriber->getCustomerId()) {
            return $this->handleCustomerSubscriptionUpdate($subscriber);
        }

        if (!$this->responseRateManager->check($subscriber->getStoreId()) ||
            !$this->generalConfig->getIsRealTimeSynchronizationEnabled()
        ) {
            $this->subscriberAttributeUpdater->setIsImported($subscriberId, 0);

            return;
        }

        $response = $this->subscriberDataSender->send($subscriber);
        $isImported = $this->importStatus->getImportStatus($response);
        $this->subscriberAttributeUpdater->setIsImported($subscriberId, $isImported);
    }

    /**
     * @param BaseSubscriber $subscriber
     */
    protected function handleCustomerSubscriptionUpdate($subscriber)
    {
        if (!$subscriber instanceof BaseSubscriber) {
            return;
        }

        $customerId = $subscriber->getCustomerId();

        if (!$this->responseRateManager->check($subscriber->getStoreId()) ||
            !$this->generalConfig->getIsRealTimeSynchronizationEnabled() ||
            !$subscriber->getSubscriberId()
        ) {
            $this->customerAttributeUpdater->setIsImported($customerId, 0);

            return;
        }

        $response = $this->subscriberDataSender->send($subscriber);
        $isImported = $this->importStatus->getImportStatus($response);
        $this->customerAttributeUpdater->setIsImported($customerId, $isImported);
    }
}