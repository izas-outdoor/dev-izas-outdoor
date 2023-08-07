<?php

namespace Seonov\Customer\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Customer setup factory
     *
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * Constructor
     *
     * @param EavSetupFactory $eavSetupFactory
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        CustomerSetupFactory $customerSetupFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $attributeCode = 'skiing';

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            $attributeCode,
            [
                'type' => 'int',
                'label' => 'Skiing',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'position' => 300,
                'system' => 0,
                'backend' => ''
            ]
        );

        // show the attribute in the following forms
        $attribute = $customerSetup
                        ->getEavConfig()
                        ->getAttribute(
                            \Magento\Customer\Model\Customer::ENTITY,
                            $attributeCode
                        )
                        ->setData(
                            ['used_in_forms' => [
                                'adminhtml_customer',
                                'adminhtml_checkout',
                                'customer_account_create',
                                'customer_account_edit'
                            ]
                        ]);

        //$attribute->save();
        $attributeCode2 = 'running';

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            $attributeCode2,
            [
                'type' => 'int',
                'label' => 'Running',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'position' => 300,
                'system' => 0,
                'backend' => ''
            ]
        );

        // show the attribute in the following forms
        $attribute = $customerSetup
                        ->getEavConfig()
                        ->getAttribute(
                            \Magento\Customer\Model\Customer::ENTITY,
                            $attributeCode2
                        )
                        ->setData(
                            ['used_in_forms' => [
                                'adminhtml_customer',
                                'adminhtml_checkout',
                                'customer_account_create',
                                'customer_account_edit'
                            ]
                        ]);

        //$attribute->save();
        $attributeCode3 = 'cycling';

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            $attributeCode3,
            [
                'type' => 'int',
                'label' => 'Cycling',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'position' => 300,
                'system' => 0,
                'backend' => ''
            ]
        );

        // show the attribute in the following forms
        $attribute = $customerSetup
                        ->getEavConfig()
                        ->getAttribute(
                            \Magento\Customer\Model\Customer::ENTITY,
                            $attributeCode3
                        )
                        ->setData(
                            ['used_in_forms' => [
                                'adminhtml_customer',
                                'adminhtml_checkout',
                                'customer_account_create',
                                'customer_account_edit'
                            ]
                        ]);

        //$attribute->save();
        $attributeCode4 = 'climbing';

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            $attributeCode4,
            [
                'type' => 'int',
                'label' => 'Climbing',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'position' => 300,
                'system' => 0,
                'backend' => ''
            ]
        );

        // show the attribute in the following forms
        $attribute = $customerSetup
                        ->getEavConfig()
                        ->getAttribute(
                            \Magento\Customer\Model\Customer::ENTITY,
                            $attributeCode4
                        )
                        ->setData(
                            ['used_in_forms' => [
                                'adminhtml_customer',
                                'adminhtml_checkout',
                                'customer_account_create',
                                'customer_account_edit'
                            ]
                        ]);

        //$attribute->save();
        $attributeCode5 = 'kids';

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            $attributeCode5,
            [
                'type' => 'int',
                'label' => 'Kids',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'position' => 300,
                'system' => 0,
                'backend' => ''
            ]
        );

        // show the attribute in the following forms
        $attribute = $customerSetup
                        ->getEavConfig()
                        ->getAttribute(
                            \Magento\Customer\Model\Customer::ENTITY,
                            $attributeCode5
                        )
                        ->setData(
                            ['used_in_forms' => [
                                'adminhtml_customer',
                                'adminhtml_checkout',
                                'customer_account_create',
                                'customer_account_edit'
                            ]
                        ]);

        //$attribute->save();
        $attributeCode6 = 'fashion';

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            $attributeCode6,
            [
                'type' => 'int',
                'label' => 'Fashion',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'position' => 300,
                'system' => 0,
                'backend' => ''
            ]
        );

        // show the attribute in the following forms
        $attribute = $customerSetup
                        ->getEavConfig()
                        ->getAttribute(
                            \Magento\Customer\Model\Customer::ENTITY,
                            $attributeCode6
                        )
                        ->setData(
                            ['used_in_forms' => [
                                'adminhtml_customer',
                                'adminhtml_checkout',
                                'customer_account_create',
                                'customer_account_edit'
                            ]
                        ]);

        //$attribute->save();
        $attributeCode7 = 'hiking';

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            $attributeCode7,
            [
                'type' => 'int',
                'label' => 'Hiking',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'position' => 300,
                'system' => 0,
                'backend' => ''
            ]
        );

        // show the attribute in the following forms
        $attribute = $customerSetup
                        ->getEavConfig()
                        ->getAttribute(
                            \Magento\Customer\Model\Customer::ENTITY,
                            $attributeCode7
                        )
                        ->setData(
                            ['used_in_forms' => [
                                'adminhtml_customer',
                                'adminhtml_checkout',
                                'customer_account_create',
                                'customer_account_edit'
                            ]
                        ]);

        $attribute->save();
        $setup->endSetup();
    }
}
