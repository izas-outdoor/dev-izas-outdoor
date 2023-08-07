<?php

namespace Omnisend\Omnisend\Model\ResourceModel;

use Omnisend\Omnisend\Setup\InstallData;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Sales\Api\Data\OrderInterface;

class Order extends AbstractDb
{
    const TABLE_ORDER = 'sales_order';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_ORDER, OrderInterface::ENTITY_ID);
    }

    /**
     * @param $orderId
     * @param $isImported
     */
    public function updateIsImported($orderId, $isImported)
    {
        $this->getConnection()->update(
            self::TABLE_ORDER,
            [InstallData::IS_IMPORTED => $isImported],
            OrderInterface::ENTITY_ID . ' = ' . $orderId
        );
    }

    /**
     * @return int
     */
    public function resetIsImportedValues()
    {
        return $this->getConnection()->update(
            self::TABLE_ORDER,
            [InstallData::IS_IMPORTED => InstallData::DEFAULT_IS_IMPORTED_VALUE],
            InstallData::IS_IMPORTED . ' = ' . InstallData::IMPORTED_ATTRIBUTE_VALUE
        );
    }
}
