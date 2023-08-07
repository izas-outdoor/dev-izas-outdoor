<?php

namespace Omnisend\Omnisend\Model;

use Omnisend\Omnisend\Api\Data\OmnisendContactInterface;
use Omnisend\Omnisend\Api\Data\OmnisendGuestSubscriberInterface;
use Magento\Newsletter\Model\Subscriber;

interface UnsubscriptionServiceInterface
{
    /**
     * @param Subscriber $subscription
     * @param OmnisendContactInterface[] $contacts
     * @param OmnisendGuestSubscriberInterface[] $guestSubscribers
     * @return bool
     */
    public function unsubscribeFromAllStores($subscription, $contacts, $guestSubscribers);
}