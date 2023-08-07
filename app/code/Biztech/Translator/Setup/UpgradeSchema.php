<?php

namespace Biztech\Translator\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Config\Model\ResourceModel\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;

class UpgradeSchema implements UpgradeSchemaInterface
{
    protected $productMetadataInterface;
    protected $resourceConfig;
    protected $scopeConfig;
    protected $_date;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        Config $resourceConfig,
        ScopeConfigInterface $scopeConfig,
        ProductMetadataInterface $productMetadataInterface,
        DateTime $datetime
    ) {
        $this->resourceConfig = $resourceConfig;
        $this->productMetadataInterface = $productMetadataInterface;
        $this->_eavSetupFactory = $eavSetupFactory;
        $this->scopeConfig = $scopeConfig;
        $this->_date = $datetime;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Mass Translation Feature Introduced
         */
        if (version_compare($context->getVersion(), '1.0.2') < 0) {
            /** @var EavSetup $eavSetup */
            $insSetup = $this->_eavSetupFactory->create()->getSetup();
            $eavSetup = $this->_eavSetupFactory->create(['setup' => $insSetup]);
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'translated',
                [
                    'type' => 'int',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Product Translated',
                    'input' => 'boolean',
                    'class' => '',
                    'group' => 'General',
                    'global' => Attribute::SCOPE_STORE,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => true,
                    'default' => '',
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => false,
                    'unique' => false,
                    'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                    'apply_to' => 'simple,configurable,virtual,bundle,downloadable',
                ]
            );
            
            if (!$installer->tableExists('translator_cron')) {
                $table = $installer->getConnection()
                    ->newTable($installer->getTable('translator_cron'))
                    ->addColumn('id', Table::TYPE_INTEGER, null, [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true,
                    ], 'Id')
                    ->addColumn('store_id', Table::TYPE_INTEGER, null, [
                        'unsigned' => true,
                        'nullable' => false,
                        'default' => '0',
                    ], 'Store id')
                    ->addColumn('cron_date', Table::TYPE_DATETIME, null, [
                        'nullable' => false,
                    ], 'Date and Time of Cron RUN')
                    ->addColumn('update_cron_date', Table::TYPE_DATETIME, null, [
                        'nullable' => false,
                    ], 'Date and Time of Cron RUN')
                    ->addColumn('cron_name', Table::TYPE_TEXT, 50, [], 'Cron Name')
                    ->addColumn('product_ids', Table::TYPE_TEXT, null, [], 'Product Ids selected to translate')
                    ->addColumn('lang_from', Table::TYPE_TEXT, 5, [], 'Language From')
                    ->addColumn('lang_to', Table::TYPE_TEXT, 5, [], 'Language to')
                    ->addColumn('status', Table::TYPE_TEXT, 50, [], 'abort,pending,processing,success')
                    ->addColumn('is_abort', Table::TYPE_INTEGER, 2, [
                        'nullable' => true,
                        'default' => 0,
                    ], 'is aborted')
                    ->setComment('manage translate cron');

                $installer->getConnection()->createTable($table);
            }

            if (!$installer->tableExists('translator_logcron')) {
                $table = $installer->getConnection()
                    ->newTable($installer->getTable('translator_logcron'))
                    ->addColumn('trans_id', Table::TYPE_INTEGER, null, [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true,
                    ], 'Id')
                    ->addColumn('cron_job_code', Table::TYPE_TEXT, 255, [
                        'nullable' => false,
                    ], 'Cron JOB CODE')
                    ->addColumn('cron_date', Table::TYPE_DATETIME, null, [
                        'nullable' => false,
                    ], 'Date and Time of Cron RUN')
                    ->addColumn('status', Table::TYPE_INTEGER, null, [
                        'nullable' => false,
                        'default' => 0,
                    ], 'Status 0 => failed, 1 => success, 2 => abort')
                    ->addColumn('store_id', Table::TYPE_INTEGER, null, [
                        'nullable' => false,
                        'default' => 0,
                    ], 'Store Id')
                    ->addColumn('product_id', Table::TYPE_INTEGER, null, [
                        'nullable' => false,
                    ], 'Last Translated Product Id')
                    ->addColumn('remain_limit', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [
                        'nullable' => true,
                        'default' => 0,
                    ], 'Remaining Daily Limit')
                    ->setComment('manage translate cron log');

                $installer->getConnection()->createTable($table);
            }
        }
        if (version_compare($context->getVersion(), '2.0.0') < 0) {
            $version = $this->productMetadataInterface->getVersion();
            if (version_compare($version, '2.1', '<')) {
                $higherversion = 0;
                $lowerversion = 1;
            } else {
                $higherversion = 1;
                $lowerversion = 0;
            }
            $this->resourceConfig->saveConfig('translator/general/magento_higher_version', $higherversion, 'default', 0);
            $this->resourceConfig->saveConfig('translator/general/magento_lower_version', $lowerversion, 'default', 0);
    
            $insSetup = $this->_eavSetupFactory->create()->getSetup();
            $eavSetup = $this->_eavSetupFactory->create(['setup' => $insSetup]);
            $eavSetup->updateAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'translated',
                'is_used_in_grid',
                true
            );
            $eavSetup->updateAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'translated',
                'is_visible_in_grid',
                true
            );
            $eavSetup->updateAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'translated',
                'is_filterable_in_grid',
                true
            );
            $eavSetup->updateAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'translated',
                'is_searchable_in_grid',
                true
            );
        }

        if (version_compare($context->getVersion(), '2.0.1') < 0) {
            $tableName = $installer->getTable('translator_cron');
            $columnName = 'is_console';
            if ($installer->getConnection()->tableColumnExists($tableName, $columnName) === false) {
                $installer->getConnection()->addColumn(
                    $tableName,
                    $columnName,
                    ['type' => Table::TYPE_INTEGER,
                    'nullable' => true,
                    'default' => 0,
                    'comment' => 'Added product for translate using console']
                );
            }
        }
        if (version_compare($context->getVersion(), '2.0.7') < 0) {
            if (!$installer->tableExists('translate_in_all_storeview')) {
                $table = $installer->getConnection()
                    ->newTable($installer->getTable('translate_in_all_storeview'))
                    ->addColumn('id', Table::TYPE_INTEGER, null, [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true,
                    ], 'Id')
                    ->addColumn('store_ids', Table::TYPE_TEXT, null, [
                        'nullable' => false
                    ], 'Store ids')
                    ->addColumn('cron_name', Table::TYPE_TEXT, 50, [], 'Cron Name')
                    ->addColumn('product_ids', Table::TYPE_TEXT, null, [], 'Product Ids selected to translate in all storeview')
                    ->addColumn('succeed_store_ids', Table::TYPE_TEXT, null, [
                        'nullable' => true
                    ], 'Translation succeed in Store ids')
                    ->addColumn('lang_from', Table::TYPE_TEXT, null, [], 'Language From')
                    ->addColumn('lang_to', Table::TYPE_TEXT, null, [], 'Language to')
                    ->addColumn('status', Table::TYPE_TEXT, 50, [], 'abort,pending,processing,success')
                    ->addColumn('is_abort', Table::TYPE_INTEGER, 2, [
                        'nullable' => true,
                        'default' => 0,
                    ], 'is aborted')
                    ->addColumn('cron_date', Table::TYPE_DATETIME, null, [
                        'nullable' => false,
                    ], 'Date and Time of Cron Run')
                    ->addColumn('update_cron_date', Table::TYPE_DATETIME, null, [
                        'nullable' => false,
                    ], 'Date and Time of Cron Update')
                    ->setComment('manage translate cron for translate products in all store view');
                $installer->getConnection()->createTable($table);
            }
            if (!$installer->tableExists('translate_newly_added_product')) {
                $table = $installer->getConnection()
                    ->newTable($installer->getTable('translate_newly_added_product'))
                    ->addColumn('id', Table::TYPE_INTEGER, null, [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true,
                    ], 'Id')
                    ->addColumn('store_ids', Table::TYPE_TEXT, null, [
                        'nullable' => false
                    ], 'Store ids')
                    ->addColumn('cron_name', Table::TYPE_TEXT, 50, [], 'Cron Name')
                    ->addColumn('product_ids', Table::TYPE_TEXT, null, [], 'Product Ids selected to translate in all storeview')
                    ->addColumn('succeed_store_ids', Table::TYPE_TEXT, null, [
                        'nullable' => true
                    ], 'Translation succeed in Store ids')
                    ->addColumn('lang_from', Table::TYPE_TEXT, null, [], 'Language From')
                    ->addColumn('lang_to', Table::TYPE_TEXT, null, [], 'Language to')
                    ->addColumn('status', Table::TYPE_TEXT, 50, [], 'abort,pending,processing,success')
                    ->addColumn('is_abort', Table::TYPE_INTEGER, 2, [
                        'nullable' => true,
                        'default' => 0,
                    ], 'Is aborted')
                    ->addColumn('cron_date', Table::TYPE_DATETIME, null, [
                        'nullable' => false,
                    ], 'Date and Time of Cron Run')
                    ->addColumn('update_cron_date', Table::TYPE_DATETIME, null, [
                        'nullable' => false,
                    ], 'Date and Time of Cron Update')
                    ->setComment('Manage translate cron for newly added products translate in multiple store');
                $installer->getConnection()->createTable($table);
            }
            if($this->scopeConfig->getValue("translator/general/module_installed_date")==null) {
                $this->resourceConfig->saveConfig('translator/general/module_installed_date', $this->_date->gmtDate(), 'default', 0);
            }
        }
        $setup->endSetup();
    }
}
