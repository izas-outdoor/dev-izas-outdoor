<?php

namespace Amasty\Feed\Model\Category\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\VersionControl\AbstractDb;

class Mapping extends AbstractDb
{
    public const TABLE_NAME = 'amasty_feed_category_mapping';

    /**
     * Initialize table nad PK name
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, 'entity_id');
    }
}
