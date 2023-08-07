<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class AbstractResource
 * @package WebPanda\Rma\Model\ResourceModel
 */
abstract class AbstractResource extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $attributeCodes = [];

    protected $entityRefFieldName = '';

    /**
     * @var null|string
     */
    protected $attrTableName = null;

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function updateAttributeValues(\Magento\Framework\Model\AbstractModel $object)
    {
        if ($this->attrTableName === null) {
            return $this;
        }

        $connection = $this->getConnection();
        $table = $this->getTable($this->attrTableName);
        foreach ($this->attributeCodes as $attributeCode) {
            $attrValues = $object->getAttribute($attributeCode);
            if (!is_array($attrValues)) {
                continue;
            }

            $originalAttrValues = $object->getOrigData('attribute');

            foreach ($attrValues as $storeId => $value) {
                if (isset($originalAttrValues[$attributeCode][$storeId])) {
                    if ($originalAttrValues[$attributeCode][$storeId] != $value) {
                        $connection->update(
                            $table,
                            ['value' => $value],
                            [
                                $this->entityRefFieldName . ' = ?' => $object->getId(),
                                "code = ?" => $attributeCode,
                                "store_id = ?" => $storeId
                            ]
                        );
                    }
                } else {
                    $connection->insert(
                        $table,
                        [
                            $this->entityRefFieldName => $object->getId(),
                            'code' => $attributeCode,
                            'value' => $value,
                            'store_id' => $storeId
                        ]
                    );
                }
            }
        }

        return $this;
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function attachAttributeValues(\Magento\Framework\Model\AbstractModel $object)
    {
        if ($this->attrTableName === null) {
            return $this;
        }

        $defaultAttributeData = [];
        $attributeData = [];
        $connection = $this->getConnection();

        // first load the values for the default store
        foreach ($this->attributeCodes as $attributeCode) {
            $columns = [
                'store_id' => 'store_id',
                'value' => 'value'
            ];
            $select = $connection->select()
                ->from($this->getTable($this->attrTableName), $columns)
                ->where("code = ?", $attributeCode)
                ->where("{$this->entityRefFieldName} = ?", $object->getId())
            ;

            $select->where("store_id = ?", 0);

            foreach ($connection->fetchAll($select) as $data) {
                $defaultAttributeData[$attributeCode] = $data['value'];
            }
        }

        // load the data for each individual store and if not set use the default store value
        foreach ($this->attributeCodes as $attributeCode) {
            $columns = [
                'store_id' => 'store_id',
                'value' => 'value'
            ];
            $select = $connection->select()
                ->from($this->getTable($this->attrTableName), $columns)
                ->where("code = ?", $attributeCode)
                ->where("{$this->entityRefFieldName} = ?", $object->getId())
            ;

            if ($object->getStoreId()) {
                $select->where("store_id = ?", $object->getStoreId());
            }

            foreach ($connection->fetchAll($select) as $data) {
                if ($object->getStoreId()) {
                    $attributeData[$attributeCode] = $data['value'];
                } else {
                    $attributeData[$attributeCode][$data['store_id']] = $data['value'];
                }
            }
        }

        // if there is no attribute value set for a store we use the default store value
        if ($object->getStoreId()) {
            foreach ($defaultAttributeData as $attributeCode => $value) {
                if (
                    !array_key_exists($attributeCode, $attributeData) ||
                    null == $attributeData[$attributeCode]
                ) {
                    $attributeData[$attributeCode] = $value;
                }
            }
        }

        $object->setAttribute($attributeData);

        return $this;
    }
}
