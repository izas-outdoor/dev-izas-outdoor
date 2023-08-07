<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use WebPanda\Rma\Helper\Config as ConfigHelper;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Group;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Helper\Address as AddressHelper;
use Magento\Sales\Model\Order\Address\Renderer as AddressRenderer;
use Magento\Customer\Model\Address\Mapper;

/**
 * Class Customer
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab
 */
class Customer extends Generic implements TabInterface
{
    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var GroupRepositoryInterface
     */
    protected $groupRepository;

    /**
     * Account management
     *
     * @var AccountManagementInterface
     */
    protected $accountManagement;

    /**
     * @var AddressHelper
     */
    protected $addressHelper;

    /**
     * @var AddressRenderer
     */
    protected $addressRenderer;

    /**
     * Address mapper
     *
     * @var Mapper
     */
    protected $addressMapper;

    protected $packingSlip;

    /**
     * Customer constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param ConfigHelper $configHelper
     * @param CustomerFactory $customerFactory
     * @param GroupRepositoryInterface $groupRepository
     * @param AccountManagementInterface $accountManagement
     * @param AddressHelper $addressHelper
     * @param AddressRenderer $addressRenderer
     * @param Mapper $addressMapper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        ConfigHelper $configHelper,
        CustomerFactory $customerFactory,
        GroupRepositoryInterface $groupRepository,
        AccountManagementInterface $accountManagement,
        AddressHelper $addressHelper,
        AddressRenderer $addressRenderer,
        Mapper $addressMapper,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->configHelper = $configHelper;
        $this->customerFactory = $customerFactory;
        $this->groupRepository = $groupRepository;
        $this->accountManagement = $accountManagement;
        $this->addressHelper = $addressHelper;
        $this->addressRenderer = $addressRenderer;
        $this->addressMapper = $addressMapper;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $rma = $this->_coreRegistry->registry('rma_request');

        $dateFormat = $this->_localeDate->getDateTimeFormat(\IntlDateFormatter::MEDIUM);

        $customerData = [];
        if ($customer = $rma->getCustomer()) {
            /** @var \Magento\Customer\Model\Customer $customer */
            $customerData = [
                'name' => $customer->getName(),
                'email' => $customer->getEmail(),
                'url' => $this->getUrl(
                    'customer/index/edit',
                    ['id' => $customer->getId()]
                ),
                'group' => $this->getCustomerGroupName($customer->getGroupId())
            ];
        } else {
            $customerData = [
                'name'  => $rma->getCustomerName(),
                'email' => $rma->getFinalCustomerEmail(),
                'group' => $this->getCustomerGroupName(Group::NOT_LOGGED_IN_ID),
            ];
        }
        $customerData['address'] = $address = $this->addressHelper
            ->getFormatTypeRenderer('html')
            ->renderArray($this->getPackingSlip());

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rma_customer_');
        $fieldSet = $form->addFieldset('customer_fieldset', []);

        $fieldSet->addField(
            'customer_id',
            'WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element\CustomerLink',
            [
                'name' => 'customer_id',
                'label' => __('Name'),
                'title' => __('Name'),
            ]
        );

        $fieldSet->addField(
            'email',
            'note',
            [
                'label' => __('Email'),
                'text' => $customerData['email']
            ]
        );

        $fieldSet->addField(
            'contact_information',
            'note',
            [
                'label' => __('Contact Information'),
                'text' => $customerData['address']
            ]
        );

        $fieldSet->addField(
            'group_name',
            'note',
            [
                'label' => __('Customer Group'),
                'text' => $customerData['group']
            ]
        );

        $form->setValues($rma);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @param $groupId
     * @return string
     */
    public function getCustomerGroupName($groupId)
    {
        try {
            $group = $this->groupRepository->getById($groupId);
        } catch (NoSuchEntityException $e) {
            return '';
        }

        return $group->getCode();
    }

    /**
     * @param null $customerId
     * @return \Magento\Framework\Phrase|null|string
     */
    public function getBillingAddressHtml($customerId = null)
    {
        if ($customerId && $addressObject = $this->accountManagement->getDefaultBillingAddress($customerId)) {
            $address = $this->addressHelper
                ->getFormatTypeRenderer('html')
                ->renderArray($this->addressMapper->toFlatArray($addressObject));
        } else {
            $addressObject = $this->_coreRegistry->registry('rma_request')->getOrder()->getBillingAddress();
            $address = $this->addressRenderer->format($addressObject, 'html');
        }

        if ($address === null) {
            return __('The customer does not have default billing address.');
        }

        return $address;
    }

    /**
     * @return null|string
     */
    public function getShippingAddressHtml()
    {
        $addressObject = $this->_coreRegistry->registry('rma_request')->getOrder()->getShippingAddress();
        $address = $this->addressRenderer->format($addressObject, 'html');

        return $address;
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Customer Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Customer Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * @return array|null
     */
    public function getPackingSlip()
    {
        if ($this->packingSlip === null) {
            $this->packingSlip = $this->_coreRegistry->registry('rma_request')->getPackingSlip();
            $this->packingSlip['street'] = explode('\n', $this->packingSlip['street']);
        }

        return $this->packingSlip;
    }
}
