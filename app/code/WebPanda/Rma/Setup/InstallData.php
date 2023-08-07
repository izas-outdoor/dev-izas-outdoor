<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    private $statusesData = [
        '1' => [
            'code' => 'pending_approval',
            'name' => 'Pending Approval',
            'color' => '#1796FF',
            'step' => '1',
            'is_email_customer' => '0',
            'is_email_admin' => '1',
            'is_message' => '1',
            'attributes' => [
                'email_to_customer' => 'rma_email_templates_status_email_to_customer',
                'email_to_admin' => 'rma_email_templates_notify_admin_new_rma_template',
                'frontend_label' => 'Pending Approval',
                'message' => 'The request is pending approval.'
            ]
        ],
        '2' => [
            'code' => 'approved',
            'name' => 'Approved',
            'color' => '#B5CA71',
            'step' => '2',
            'is_email_customer' => '1',
            'is_email_admin' => '0',
            'is_message' => '1',
            'attributes' => [
                'email_to_customer' => 'rma_email_templates_status_email_to_customer',
                'email_to_admin' => 'rma_email_templates_status_email_to_admin',
                'frontend_label' => 'Approved',
                'message' => 'The request has been approved.'
            ]
        ],
        '3' => [
            'code' => 'canceled',
            'name' => 'Canceled',
            'color' => '#7F7F7F',
            'step' => '5',
            'is_email_customer' => '1',
            'is_email_admin' => '1',
            'is_message' => '1',
            'attributes' => [
                'email_to_customer' => 'rma_email_templates_status_email_to_customer',
                'email_to_admin' => 'rma_email_templates_status_email_to_admin',
                'frontend_label' => 'Canceled',
                'message' => 'The request has been cancelled.'
            ]
        ],
        '4' => [
            'code' => 'package_sent',
            'name' => 'Package Sent',
            'color' => '#A01497',
            'step' => '3',
            'is_email_customer' => '0',
            'is_email_admin' => '1',
            'is_message' => '1',
            'attributes' => [
                'email_to_customer' => 'rma_email_templates_status_email_to_customer',
                'email_to_admin' => 'rma_email_templates_status_email_to_admin',
                'frontend_label' => 'Package Sent',
                'message' => 'The request obtained "Package Sent" status.'
            ]
        ],
        '5' => [
            'code' => 'package_received',
            'name' => 'Package Received',
            'color' => '#CD64F5',
            'step' => '4',
            'is_email_customer' => '1',
            'is_email_admin' => '0',
            'is_message' => '1',
            'attributes' => [
                'email_to_customer' => 'rma_email_templates_status_email_to_customer',
                'email_to_admin' => 'rma_email_templates_status_email_to_admin',
                'frontend_label' => 'Package Received',
                'message' => 'The request obtained "Package Received" status.'
            ]
        ],
        '6' => [
            'code' => 'issued_refund',
            'name' => 'Issued Refund',
            'color' => '#997008',
            'step' => '4',
            'is_email_customer' => '1',
            'is_email_admin' => '0',
            'is_message' => '1',
            'attributes' => [
                'email_to_customer' => 'rma_email_templates_status_email_to_customer',
                'email_to_admin' => 'rma_email_templates_status_email_to_admin',
                'frontend_label' => 'Issued Refund',
                'message' => 'The request obtained "Issue Refund" status.'
            ]
        ],
        '7' => [
            'code' => 'complete',
            'name' => 'Complete',
            'color' => '#48982B',
            'step' => '5',
            'is_email_customer' => '1',
            'is_email_admin' => '0',
            'is_message' => '1',
            'attributes' => [
                'email_to_customer' => 'rma_email_templates_status_email_to_customer',
                'email_to_admin' => 'rma_email_templates_status_email_to_admin',
                'frontend_label' => 'Complete',
                'message' => 'The request has been completed.'
            ]
        ],
    ];

    private $resolutionOptions = [
        '1' => [
            'options' => 'Replacement'
        ],
        '2' => [
            'options' => 'Refund'
        ],
        '3' => [
            'options' => 'Repair'
        ]
    ];

    private $itemConditionOptions = [
        '1' => [
            'options' => 'Opened'
        ],
        '2' => [
            'options' => 'Not opened'
        ],
        '3' => [
            'options' => 'Damaged'
        ]
    ];

    private $reasonOptions = [
        '1' => [
            'options' => 'Wrong size'
        ],
        '2' => [
            'options' => 'Wrong color'
        ],
        '3' => [
            'options' => 'Wrong item'
        ],
        '4' => [
            'options' => 'Item is broken'
        ],
        '5' => [
            'options' => 'Item doesn\'t work as expected'
        ],
    ];

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Magento\Config\Model\ResourceModel\Config
     */
    protected $resourceConfig;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $serializer;

    /**
     * @var \Magento\Cms\Api\BlockRepositoryInterface
     */
    private $blockRepository;

    /**
     * @var \Magento\Cms\Api\Data\BlockInterfaceFactory
     */
    protected $blockInterfaceFactory;

    /**
     * InstallData constructor.
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Config\Model\ResourceModel\Config $resourceConfig
     * @param \Magento\Framework\Serialize\Serializer\Json $serializer
     * @param \Magento\Cms\Api\BlockRepositoryInterface $blockRepository
     * @param \Magento\Cms\Api\Data\BlockInterfaceFactory $blockInterfaceFactory
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Config\Model\ResourceModel\Config $resourceConfig,
        \Magento\Framework\Serialize\Serializer\Json $serializer,
        \Magento\Cms\Api\BlockRepositoryInterface $blockRepository,
        \Magento\Cms\Api\Data\BlockInterfaceFactory $blockInterfaceFactory
    ) {
        $this->storeManager = $storeManager;
        $this->resourceConfig = $resourceConfig;
        $this->serializer = $serializer;
        $this->blockRepository = $blockRepository;
        $this->blockInterfaceFactory = $blockInterfaceFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->importStatuses($setup);
        $this->importConfigOptions($setup);
        $this->importBlock($setup);
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    private function importStatuses(ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        foreach ($this->statusesData as $statusId => $statusData) {
            $connection->insert(
                $setup->getTable('wp_rma_status'),
                [
                    'id' => $statusId,
                    'code' => $statusData['code'],
                    'is_core' => 1,
                    'name' => $statusData['name'],
                    'color' => $statusData['color'],
                    'step' => $statusData['step'],
                    'is_email_customer' => $statusData['is_email_customer'],
                    'is_email_admin' => $statusData['is_email_admin'],
                    'is_message' => $statusData['is_message']
                ]
            );
            foreach ($statusData['attributes'] as $code => $attrValue) {
                // insert the attribute value for the default store
                $connection->insert(
                    $setup->getTable('wp_rma_status_attribute'),
                    [
                        'status_id' => $statusId,
                        'code' => $code,
                        'value' => $attrValue,
                        'store_id' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
                    ]
                );
                // insert the attribute value for each store
                foreach ($this->storeManager->getStores() as $store) {
                    $connection->insert(
                        $setup->getTable('wp_rma_status_attribute'),
                        [
                            'status_id' => $statusId,
                            'code' => $code,
                            'value' => $attrValue,
                            'store_id' => $store->getId()
                        ]
                    );
                }
            }
        }
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    private function importConfigOptions(ModuleDataSetupInterface $setup)
    {
        $this->resourceConfig->saveConfig(
            'rma/resolution/options',
            $this->serializer->serialize($this->resolutionOptions),
            \Magento\Framework\App\ScopeInterface::SCOPE_DEFAULT,
            0
        );

        $this->resourceConfig->saveConfig(
            'rma/item_condition/options',
            $this->serializer->serialize($this->itemConditionOptions),
            \Magento\Framework\App\ScopeInterface::SCOPE_DEFAULT,
            0
        );

        $this->resourceConfig->saveConfig(
            'rma/reason/options',
            $this->serializer->serialize($this->reasonOptions),
            \Magento\Framework\App\ScopeInterface::SCOPE_DEFAULT,
            0
        );
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    private function importBlock(ModuleDataSetupInterface $setup)
    {
        /** @var BlockInterface $cmsBlock */
        $cmsBlock = $this->blockInterfaceFactory->create();
        $content = <<<HTML
<h3>Congratulations! Your Return Request is Approved</h3>
<h4>If you wish to return an item please follow the instructions below:</h4>
<p>1. Print Packing Slip by clicking the button below.</p>
<p><button id="instructions-print-packing-slip-button" class="action primary" title="Print Packing Slip" type="button"> <span>Print Packing Slip</span> </button></p>
<p>2. Pack the item(s) securely in the original product packaging, if possible. All items must be returned in good condition to ensure that you receive credit. Before sending your return shipment, please remove all extra labels from the outside of the package. Now add the printed packing slip into your package.</p>
<p>3. The package should be shipped pre-paid.</p>
HTML;
        $cmsBlock->setIdentifier('return-instructions');
        $cmsBlock->setTitle('Return Instructions');
        $cmsBlock->setContent($content);
        $cmsBlock->setData('stores', [\Magento\Store\Model\Store::DEFAULT_STORE_ID]); // DEFAULT_STORE_ID = 0
        $this->blockRepository->save($cmsBlock);
    }
}
