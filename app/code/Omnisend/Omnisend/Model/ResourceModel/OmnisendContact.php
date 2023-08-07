<?php

namespace Omnisend\Omnisend\Model\ResourceModel;

use Omnisend\Omnisend\Api\Data\OmnisendContactInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OmnisendContact extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(OmnisendContactInterface::TABLE_NAME, OmnisendContactInterface::ID);
    }

    public function clearTable()
    {
        $this->getConnection()->truncateTable(OmnisendContactInterface::TABLE_NAME);
    }
}