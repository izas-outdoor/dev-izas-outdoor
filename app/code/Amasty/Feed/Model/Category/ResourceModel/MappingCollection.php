<?php

namespace Amasty\Feed\Model\Category\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class MappingCollection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Amasty\Feed\Model\Category\Mapping::class,
            \Amasty\Feed\Model\Category\ResourceModel\Mapping::class
        );
    }
}
