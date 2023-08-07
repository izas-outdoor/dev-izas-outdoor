<?php

namespace Omnisend\Omnisend\Model\Attribute\IsImported;

use Omnisend\Omnisend\Model\ResourceModel\OrderFactory;

class OrderAttributeUpdater implements AttributeUpdaterInterface
{
    /**
     * @var OrderFactory
     */
    private $orderFactory;

    /**
     * @param OrderFactory $orderFactory
     */
    public function __construct(OrderFactory $orderFactory)
    {
        $this->orderFactory = $orderFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsImported($entityId, $isImported)
    {
        $order = $this->orderFactory->create();
        $order->updateIsImported($entityId, $isImported);
    }
}