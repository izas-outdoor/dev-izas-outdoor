<?php

namespace Omnisend\Omnisend\Model\ResourceModel\OmnisendOrderStatus;

use Omnisend\Omnisend\Api\Data\OmnisendOrderStatusInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = OmnisendOrderStatusInterface::STATUS;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Omnisend\Omnisend\Model\OmnisendOrderStatus',
            'Omnisend\Omnisend\Model\ResourceModel\OmnisendOrderStatus'
        );
    }
}