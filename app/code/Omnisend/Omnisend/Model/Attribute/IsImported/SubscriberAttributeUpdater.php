<?php

namespace Omnisend\Omnisend\Model\Attribute\IsImported;

use Omnisend\Omnisend\Model\ResourceModel\SubscriberFactory;

class SubscriberAttributeUpdater implements AttributeUpdaterInterface
{
    /**
     * @var SubscriberFactory
     */
    private $subscriberResourceFactory;

    /**
     * @param SubscriberFactory $subscriberResourceFactory
     */
    public function __construct(SubscriberFactory $subscriberResourceFactory)
    {
        $this->subscriberResourceFactory = $subscriberResourceFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsImported($entityId, $isImported)
    {
        $subscriber = $this->subscriberResourceFactory->create();
        $subscriber->updateIsImported($entityId, $isImported);
    }
}