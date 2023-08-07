<?php

namespace Omnisend\Omnisend\Model\ResourceModel;

use Omnisend\Omnisend\Setup\InstallData;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Quote extends AbstractDb
{
    const TABLE_QUOTE = 'quote';
    const KEY_ENTITY_ID = 'entity_id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_QUOTE, self::KEY_ENTITY_ID);
    }

    /**
     * @param $quoteId
     * @param $isImported
     */
    public function updateIsImported($quoteId, $isImported)
    {
        $this->getConnection()->update(
            self::TABLE_QUOTE,
            [InstallData::IS_IMPORTED => $isImported],
            self::KEY_ENTITY_ID . ' = ' . $quoteId
        );
    }

    /**
     * @return int
     */
    public function resetIsImportedValues()
    {
        return $this->getConnection()->update(
            self::TABLE_QUOTE,
            [InstallData::IS_IMPORTED => InstallData::DEFAULT_IS_IMPORTED_VALUE],
            InstallData::IS_IMPORTED . ' = ' . InstallData::IMPORTED_ATTRIBUTE_VALUE
        );
    }
}
