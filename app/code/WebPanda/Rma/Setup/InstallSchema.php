<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'wp_rma'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('wp_rma'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'RMA ID'
            )
            ->addColumn(
                'order_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Order ID'
            )
            ->addColumn(
                'customer_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => true],
                'Customer ID'
            )
            ->addColumn(
                'customer_name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Customer Name'
            )
            ->addColumn(
                'customer_email',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Customer Email'
            )
            ->addColumn(
                'status_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => true],
                'Status ID'
            )
            ->addColumn(
                'status_name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Status Name'
            )
            ->addColumn(
                'packing_slip',
                Table::TYPE_TEXT,
                Table::DEFAULT_TEXT_SIZE,
                ['nullable' => true],
                'Packing Slip'
            )
            ->addColumn(
                'store_id',
                Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => true],
                'Store ID'
            )
            ->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'Created At'
            )
            ->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            )
            ->addForeignKey(
                $installer->getFkName('wp_rma', 'store_id', 'store', 'store_id'),
                'store_id',
                $installer->getTable('store'),
                'store_id',
                Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $installer->getFkName('wp_rma', 'status_id', 'wp_rma_status', 'id'),
                'status_id',
                $installer->getTable('wp_rma_status'),
                'id',
                Table::ACTION_SET_NULL
            )
            ->addForeignKey(
                $installer->getFkName('wp_rma', 'customer_id', 'customer_entity', 'entity_id'),
                'customer_id',
                $installer->getTable('customer_entity'),
                'entity_id',
                Table::ACTION_SET_NULL
            )
            ->addForeignKey(
                $installer->getFkName('wp_rma', 'order_id', 'sales_order', 'entity_id'),
                'order_id',
                $installer->getTable('sales_order'),
                'entity_id',
                Table::ACTION_CASCADE
            )
            ->setComment('RMA Request');
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'wp_rma_item'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('wp_rma_item'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Id'
            )
            ->addColumn(
                'rma_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'RMA Id'
            )
            ->addColumn(
                'order_item_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Order Item Id'
            )
            ->addColumn(
                'qty',
                Table::TYPE_FLOAT,
                null,
                ['unsigned' => true, 'default' => 0],
                'Qty'
            )
            ->addForeignKey(
                $installer->getFkName('wp_rma_item', 'rma_id', 'wp_rma', 'id'),
                'rma_id',
                $installer->getTable('wp_rma'),
                'id',
                Table::ACTION_CASCADE
            )
            ->setComment('RMA Request Item');
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'wp_rma_status'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('wp_rma_status'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Status Id'
            )
            ->addColumn(
                'code',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Status Code'
            )
            ->addColumn(
                'is_core',
                Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false],
                'Is Core Status'
            )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Name'
            )
            ->addColumn(
                'color',
                Table::TYPE_TEXT,
                45,
                ['nullable' => false],
                'Status Color'
            )
            ->addColumn(
                'is_email_customer',
                Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false],
                'Email To Customer'
            )
            ->addColumn(
                'is_email_admin',
                Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false],
                'Email To Admin'
            )
            ->addColumn(
                'is_message',
                Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false],
                'Is Message'
            )
            ->addColumn(
                'step',
                Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'default' => 1],
                'Step'
            )
            ->setComment('RMA Request Status');
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'wp_rma_status_attribute'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('wp_rma_status_attribute'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Id'
            )
            ->addColumn(
                'status_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Status Id'
            )
            ->addColumn(
                'code',
                Table::TYPE_TEXT,
                255,
                ['unsigned' => true, 'nullable' => false],
                'Attribute Code'
            )
            ->addColumn(
                'value',
                Table::TYPE_TEXT,
                Table::DEFAULT_TEXT_SIZE,
                ['nullable' => false],
                'Value'
            )
            ->addColumn(
                'store_id',
                Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Store ID'
            )
            ->addForeignKey(
                $installer->getFkName('wp_rma_status_attribute', 'store_id', 'store', 'store_id'),
                'store_id',
                $installer->getTable('store'),
                'store_id',
                Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $installer->getFkName('wp_rma_status_attribute', 'status_id', 'wp_rma_status', 'id'),
                'status_id',
                $installer->getTable('wp_rma_status'),
                'id',
                Table::ACTION_CASCADE
            )
            ->setComment('RMA Status Attributes');
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'wp_rma_message'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('wp_rma_message'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Message Id'
            )
            ->addColumn(
                'rma_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'RMA Id'
            )
            ->addColumn(
                'text',
                Table::TYPE_TEXT,
                Table::DEFAULT_TEXT_SIZE,
                ['nullable' => false],
                'Message Text'
            )
            ->addColumn(
                'owner_type',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false],
                'Owner Type'
            )
            ->addColumn(
                'owner_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => true],
                'Owner Id'
            )
            ->addColumn(
                'is_auto',
                Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false, 'default' => 0],
                'Is Auto'
            )
            ->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'Created At'
            )
            ->addForeignKey(
                $installer->getFkName('wp_rma_message', 'rma_id', 'wp_rma', 'id'),
                'rma_id',
                $installer->getTable('wp_rma'),
                'id',
                Table::ACTION_CASCADE
            )
            ->setComment('RMA Messages');
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'wp_rma_message_attachment'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('wp_rma_message_attachment'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Attachment Id'
            )
            ->addColumn(
                'message_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true],
                'Message Id'
            )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                Table::DEFAULT_TEXT_SIZE,
                ['nullable' => false],
                'Name'
            )
            ->addColumn(
                'content',
                Table::TYPE_BLOB,
                '10M',
                ['nullable' => false],
                'Content'
            )
            ->addForeignKey(
                $installer->getFkName('wp_rma_message_attachment', 'message_id', 'wp_rma_message', 'id'),
                'message_id',
                $installer->getTable('wp_rma_message'),
                'id',
                Table::ACTION_CASCADE
            )
            ->setComment('RMA Message Attachments');
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
