<?PHP

namespace Experius\ExtraCheckoutAddressFields\Setup;


use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;


class UpgradeData implements UpgradeDataInterface
{
/**
     * @var CustomerSetupFactory
     */

    protected $customerSetupFactory;
 
    private $attributeSetFactory;
 
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }


    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context){

       if (version_compare($context->getVersion(), '1.0.1') < 0) {
	       
	       $datosCustomerAddress = [

	            'digi_code' => [
	                'config' => [
	                     'type' => 'varchar',
	                     'label' => 'Comuna',
	                     'input' => 'text',
	                     'required' => false,
	                     'visible' => true,
	                     'user_defined' => false,
	                     'sort_order' => 1001,
	                     'position' => 333,	                 
                         'visible' => true,
                        'system' => false,
                        'is_used_in_grid' => false,
                        'is_visible_in_grid' => false,
                        'is_filterable_in_grid' => false,
                        'is_searchable_in_grid' => false,
                        'backend' => ''
	                ],
	                'used_in_forms' => ['adminhtml_customer_address']
	            ]
	        ];


	        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
	        
	        $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
	        $attributeSetId = $customerEntity->getDefaultAttributeSetId();
	        
	        $attributeSet = $this->attributeSetFactory->create();
	        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
	         

	        foreach ($datosCustomerAddress as $key => $value) {
	            
	            $customerSetup->addAttribute(  \Magento\Customer\Api\AddressMetadataInterface::ENTITY_TYPE_ADDRESS, $key, $value['config']);
	        
	            $attribute = $customerSetup->getEavConfig()->getAttribute(  \Magento\Customer\Api\AddressMetadataInterface::ENTITY_TYPE_ADDRESS, $key)
                ->addData([
                    'used_in_forms' => [
                        'customer_address_edit',
                        'customer_register_address'
                    ]
                ]);
	        
	            $attribute->save();

	        }
   		}
    
    }
}
