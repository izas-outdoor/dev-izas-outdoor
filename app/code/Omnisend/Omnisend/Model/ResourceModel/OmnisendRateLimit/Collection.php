<?php

namespace Omnisend\Omnisend\Model\ResourceModel\OmnisendRateLimit;

use Omnisend\Omnisend\Api\Data\OmnisendRateLimitInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = OmnisendRateLimitInterface::ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Omnisend\Omnisend\Model\OmnisendRateLimit',
            'Omnisend\Omnisend\Model\ResourceModel\OmnisendRateLimit'
        );
    }
}