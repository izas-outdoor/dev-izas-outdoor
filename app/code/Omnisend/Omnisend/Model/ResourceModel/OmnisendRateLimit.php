<?php

namespace Omnisend\Omnisend\Model\ResourceModel;

use Omnisend\Omnisend\Api\Data\OmnisendRateLimitInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OmnisendRateLimit extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(OmnisendRateLimitInterface::TABLE_NAME, OmnisendRateLimitInterface::ID);
        $this->_isPkAutoIncrement = false;
    }
}