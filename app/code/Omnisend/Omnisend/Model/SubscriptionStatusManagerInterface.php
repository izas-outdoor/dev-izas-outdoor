<?php

namespace Omnisend\Omnisend\Model;

use Magento\Newsletter\Model\Subscriber;

interface SubscriptionStatusManagerInterface
{
    const SUBSCRIPTION_STATUS = 'subscriptionStatus';
    const STATUS_DATE = 'statusDate';

    const IS_SUBSCRIBED = 'is_subscribed';

    const STATUS_SUBSCRIBED = "subscribed";
    const STATUS_UNSUBSCRIBED = "unsubscribed";
    const STATUS_NON_SUBSCRIBED = "nonSubscribed";

    /**
     * @param int $customerId
     * @return array
     */
    public function handleCustomerSubscriptionStatus($customerId);

    /**
     * @param Subscriber $subscriber
     * @return array
     */
    public function handleGuestSubscriptionStatus($subscriber);
}