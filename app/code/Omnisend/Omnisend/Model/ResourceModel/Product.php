<?php

namespace Omnisend\Omnisend\Model\ResourceModel;

use Omnisend\Omnisend\Setup\InstallData;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Eav\Model\ResourceModel\Entity\Attribute;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Catalog\Model\Product as ProductModel;

class Product extends AbstractDb
{
    const TABLE_CATALOG_PRODUCT_ENTITY = 'catalog_product_entity';
    const TABLE_CATALOG_PRODUCT_ENTITY_INT = 'catalog_product_entity_int';

    const ENTITY_ID = 'entity_id';
    const ATTRIBUTE_ID = 'attribute_id';
    const VALUE = 'value';
    const STORE_ID = 'store_id';

    /**
     * @var Attribute
     */
    private $eavAttribute;

    /**
     * @param Context $context
     * @param Attribute $eavAttribute
     * @param null $connectionName
     */
    public function __construct(
        Context $context,
        Attribute $eavAttribute,
        $connectionName = null
    ) {
        $this->eavAttribute = $eavAttribute;

        parent::__construct($context, $connectionName);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_CATALOG_PRODUCT_ENTITY, self::ENTITY_ID);
    }

    /**
     * @param $productId
     * @param $isImported
     * @param $storeId
     */
    public function updateIsImported($productId, $isImported, $storeId)
    {
        $isImportedAttributeId = $this->eavAttribute->getIdByCode(ProductModel::ENTITY, InstallData::IS_IMPORTED);

        $this->getConnection()->insertOnDuplicate(
            $this->getTable(self::TABLE_CATALOG_PRODUCT_ENTITY_INT),
            [
                self::ENTITY_ID => $productId,
                self::ATTRIBUTE_ID => $isImportedAttributeId,
                self::STORE_ID => $storeId,
                self::VALUE => $isImported
            ],
            [self::VALUE]
        );
    }

    /**
     * @return int
     */
    public function resetIsImportedValues()
    {
        $isImportedAttributeId = $this->eavAttribute->getIdByCode(ProductModel::ENTITY, InstallData::IS_IMPORTED);

        return $this->getConnection()->update(
            self::TABLE_CATALOG_PRODUCT_ENTITY_INT,
            [self::VALUE => InstallData::DEFAULT_IS_IMPORTED_VALUE],
            self::ATTRIBUTE_ID . ' = ' . $isImportedAttributeId . ' AND ' .
            self::VALUE . ' = ' . InstallData::IMPORTED_ATTRIBUTE_VALUE
        );
    }
}
