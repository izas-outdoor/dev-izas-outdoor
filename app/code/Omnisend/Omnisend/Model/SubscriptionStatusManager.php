<?php

namespace Omnisend\Omnisend\Model;

use Omnisend\Omnisend\Helper\GmtDateHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Newsletter\Model\Subscriber;
use Magento\Newsletter\Model\SubscriberFactory;
use Magento\Store\Model\ScopeInterface;

class SubscriptionStatusManager implements SubscriptionStatusManagerInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var SubscriberFactory
     */
    private $subscriberFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var GmtDateHelper
     */
    private $gmtDateHelper;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param SubscriberFactory $subscriberFactory
     * @param RequestInterface $request
     * @param GmtDateHelper $gmtDateHelper
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        SubscriberFactory $subscriberFactory,
        RequestInterface $request,
        GmtDateHelper $gmtDateHelper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->subscriberFactory = $subscriberFactory;
        $this->request = $request;
        $this->gmtDateHelper = $gmtDateHelper;
    }

    /**
     * @param int $customerId
     * @return array
     */
    public function handleCustomerSubscriptionStatus($customerId)
    {
        $customerSubscription = $this->subscriberFactory->create()->loadByCustomerId($customerId);

        if (!$customerSubscription->getId()) {
            return $this->processPostedSubscriptionStatus($this->checkPostForSubscriptionStatus());
        }

        return $this->formatSubscriptionStatusData($this->processSubscriberStatus($customerSubscription->getStatus()));
    }

    /**
     * @param Subscriber $subscriber
     * @return array
     */
    public function handleGuestSubscriptionStatus($subscriber)
    {
        return $this->formatSubscriptionStatusData($this->processSubscriberStatus($subscriber->getStatus()));
    }

    /**
     * @param int $status
     * @return string
     */
    protected function processSubscriberStatus($status)
    {
        switch ($status) {
            case Subscriber::STATUS_SUBSCRIBED:
                return self::STATUS_SUBSCRIBED;
            case Subscriber::STATUS_UNSUBSCRIBED:
                return self::STATUS_UNSUBSCRIBED;
            default:
                return self::STATUS_NON_SUBSCRIBED;
        }
    }

    /**
     * @return bool
     */
    protected function checkPostForSubscriptionStatus()
    {
        $postArray = $this->request->getPostValue();

        if (array_key_exists(self::IS_SUBSCRIBED, $postArray) && $postArray[self::IS_SUBSCRIBED] == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param bool $isSubscribed
     * @return array
     */
    protected function processPostedSubscriptionStatus($isSubscribed)
    {
        $status = self::STATUS_NON_SUBSCRIBED;

        $isConfirmNeeded = $this->scopeConfig->getValue(
            Subscriber::XML_PATH_CONFIRMATION_FLAG,
            ScopeInterface::SCOPE_STORE
        );

        if ($isSubscribed && !$isConfirmNeeded) {
            $status = self::STATUS_SUBSCRIBED;
        }

        return $this->formatSubscriptionStatusData($status);
    }

    /**
     * @param $status
     * @return array
     */
    protected function formatSubscriptionStatusData($status)
    {
        return [
            self::SUBSCRIPTION_STATUS => $status,
            self::STATUS_DATE => $this->gmtDateHelper->getGmtDate()
        ];
    }
}