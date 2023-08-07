<?php

namespace Omnisend\Omnisend\Model\ResourceModel;

use Omnisend\Omnisend\Api\Data\OmnisendGuestSubscriberInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OmnisendGuestSubscriber extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(OmnisendGuestSubscriberInterface::TABLE_NAME, OmnisendGuestSubscriberInterface::ID);
    }

    public function clearTable()
    {
        $this->getConnection()->truncateTable(OmnisendGuestSubscriberInterface::TABLE_NAME);
    }
}