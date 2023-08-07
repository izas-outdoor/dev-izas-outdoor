<?php

namespace Omnisend\Omnisend\Model\RequestBodyBuilder;

use Omnisend\Omnisend\Helper\GmtDateHelper;
use Omnisend\Omnisend\Model\SubscriptionStatusManagerInterface;
use Magento\Customer\Api\Data\CustomerInterface;

class Contact extends AbstractBodyBuilder implements RequestBodyBuilderInterface
{
    const EMAIL = 'email';
    const CREATED_AT = 'createdAt';
    const FIRST_NAME = 'firstName';
    const LAST_NAME = 'lastName';
    const STATUS = 'status';
    const STATUS_DATE = 'statusDate';
    const SEND_WELCOME_EMAIL = 'sendWelcomeEmail';

    /**
     * @var GmtDateHelper
     */
    private $gmtDateHelper;

    /**
     * @var SubscriptionStatusManagerInterface
     */
    private $subscriptionStatusManager;

    /**
     * @param GmtDateHelper $gmtDateHelper
     * @param SubscriptionStatusManagerInterface $subscriptionStatusManager
     */
    public function __construct(
        GmtDateHelper $gmtDateHelper,
        SubscriptionStatusManagerInterface $subscriptionStatusManager
    ) {
        $this->gmtDateHelper = $gmtDateHelper;
        $this->subscriptionStatusManager = $subscriptionStatusManager;
    }

    /**
     * @param CustomerInterface $customer
     * @return string
     */
    public function build($customer)
    {
        $subscriptionData = $this->subscriptionStatusManager->handleCustomerSubscriptionStatus($customer->getId());

        $this->addData(self::EMAIL, $customer->getEmail());
        $this->addData(self::CREATED_AT, $this->gmtDateHelper->getGmtDate($customer->getCreatedAt()));
        $this->addData(self::LAST_NAME, $customer->getLastname());
        $this->addData(self::FIRST_NAME, $customer->getFirstname());
        $this->addData(self::STATUS, $subscriptionData[SubscriptionStatusManagerInterface::SUBSCRIPTION_STATUS]);
        $this->addData(self::STATUS_DATE, $subscriptionData[SubscriptionStatusManagerInterface::STATUS_DATE]);
        $this->addData(self::SEND_WELCOME_EMAIL, true);

        return json_encode($this->getData());
    }
}