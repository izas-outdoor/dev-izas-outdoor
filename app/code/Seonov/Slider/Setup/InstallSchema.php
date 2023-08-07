<?php
/**
 * Copyright © 2015 Seonov. All rights reserved.
 */

namespace Seonov\Slider\Setup;

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
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;

        $installer->startSetup();

		/**
         * Create table 'slider_seonovslider'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('slider_seonovslider')
        )
		->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'slider_seonovslider'
        )
		->addColumn(
            'sliderimage',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'sliderimage'
        )
        ->addColumn(
                'mobileimage',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                [],
                'mobileimage'
            )
		->addColumn(
            'sliderbigtitle',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'sliderbigtitle'
        )
		->addColumn(
            'slidersmalltitle',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'slidersmalltitle'
        )
		->addColumn(
            'slidermenbtn',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => false],
            'slidermenbtn'
        )
		->addColumn(
            'slidermenbtnlink',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'slidermenbtnlink'
        )
    ->addColumn(
                'slidermenbtntext',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                [],
                'slidermenbtntext'
            )
		->addColumn(
            'sliderwomenbtn',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => false],
            'sliderwomenbtn'
        )
		->addColumn(
            'sliderwomenbtnlink',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'sliderwomenbtnlink'
        )
        ->addColumn(
                    'sliderwomenbtntext',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [],
                    'sliderwomenbtntext'
                )
        ->addColumn(
                        'sliderkidbtn',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        ['nullable' => false],
                        'sliderkidbtn'
                    )
        ->addColumn(
                        'sliderkidbtnlink',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        '64k',
                        [],
                        'sliderwomenbtnlink'
                    )
            ->addColumn(
                                'sliderkidbtntext',
                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                '64k',
                                [],
                                'sliderwomenbtntext'
                            )
		/*{{CedAddTableColumn}}}*/


        ->setComment(
            'Seonov Slider slider_seonovslider'
        );

		$installer->getConnection()->createTable($table);
		/*{{CedAddTable}}*/

        $installer->endSetup();

    }
}
