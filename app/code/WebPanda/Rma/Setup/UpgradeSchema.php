<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class UpgradeSchema
 * @package WebPanda\Rma\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->addRmaConfigFields($setup);
        }
    }

    /**
     * Add Resolution, Item Condition and Reason for Return fields
     *
     * @param SchemaSetupInterface $setup
     * @return $this
     */
    protected function addRmaConfigFields(SchemaSetupInterface $setup)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable('wp_rma_item'),
            'resolution_id',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 50,
                'nullable' => false,
                'comment' => 'Resolution ID'
            ]
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('wp_rma_item'),
            'resolution',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => false,
                'comment' => 'Resolution Text'
            ]
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('wp_rma_item'),
            'item_condition_id',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 50,
                'nullable' => false,
                'comment' => 'Item Condition ID'
            ]
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('wp_rma_item'),
            'item_condition',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => false,
                'comment' => 'Item Condition Text'
            ]
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('wp_rma_item'),
            'reason_id',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 50,
                'nullable' => false,
                'comment' => 'Reason for Return ID'
            ]
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('wp_rma_item'),
            'reason',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => false,
                'comment' => 'Reason for Return Text'
            ]
        );

        return $this;
    }
}
