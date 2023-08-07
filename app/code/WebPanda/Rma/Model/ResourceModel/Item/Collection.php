<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\ResourceModel\Item;

/**
 * Class Collection
 * @package WebPanda\Rma\Model\ResourceModel\Item
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('WebPanda\Rma\Model\Item', 'WebPanda\Rma\Model\ResourceModel\Item');
    }

    public function addRmaFilter($rmaId)
    {
        return $this->addFieldToFilter('rma_id', $rmaId);
    }

    public function addOrderItemFilter($orderItemId)
    {
        return $this->addFieldToFilter('order_item_id', $orderItemId);
    }

    public function joinRma()
    {
        $this->getSelect()
            ->joinInner(
                ['rma' => $this->getTable('wp_rma')],
                'main_table.rma_id = rma.id',
                [
                    'order_id' => 'rma.order_id',
                    'status_id' => 'rma.status_id'
                ]
            )
        ;

        return $this;
    }

    public function joinOrderItem()
    {
        $this->getSelect()
            ->joinLeft(
                ['order_item_table' => $this->getTable('sales_order_item')],
                'main_table.order_item_id = order_item_table.item_id',
                [
                    'product_type' => 'order_item_table.product_type',
                    'name' => 'order_item_table.name',
                    'sku' => 'order_item_table.sku',
                    'is_virtual' => 'order_item_table.is_virtual'
                ]
            )
            ->joinLeft(
                ['products' => $this->getTable('catalog_product_entity')],
                'order_item_table.product_id = products.entity_id',
                ['product_id' => 'products.entity_id']
            )
            ->joinLeft(
                ['parent_item_table_1' => $this->getTable('sales_order_item')],
                "parent_item_table_1.item_id = order_item_table.parent_item_id AND parent_item_table_1.product_type = 'configurable'",
                [
                    'base_price' => 'IFNULL(parent_item_table_1.base_price, order_item_table.base_price)',
                    'price' => 'IFNULL(parent_item_table_1.price, order_item_table.price)'
                ]
            )
            ->joinLeft(
                ['parent_item_table_2' => $this->getTable('sales_order_item')],
                "parent_item_table_2.item_id = order_item_table.parent_item_id",
                [
                    'parent_product_id' => 'parent_item_table_2.product_id'
                ]
            )
        ;

        return $this;
    }
}
