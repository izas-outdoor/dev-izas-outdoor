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
use WebPanda\Rma\Model\Source\Rma\Status as StatusSource;

/**
 * Class Main
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab
 */
class Main extends Generic implements TabInterface
{
    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * @var StatusSource
     */
    protected $statusSource;

    /**
     * Main constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param ConfigHelper $configHelper
     * @param StatusSource $statusSource
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        ConfigHelper $configHelper,
        StatusSource $statusSource,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->configHelper = $configHelper;
        $this->statusSource = $statusSource;
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


        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rma_rma_');
        
        $fieldSet = $form->addFieldset('base_fieldset', []);

        if ($rma->getId()) {
            $fieldSet->addField('id', 'hidden', ['name' => 'id']);
        }

        if (!$this->configHelper->getStatusDropdown()) {
            $fieldSet->addField(
                'status_id',
                'WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element\StatusLabel',
                [
                    'name' => 'status_id',
                    'label' => __('Current Status'),
                    'title' => __('Current Status'),
                ]
            );
        } else {
            $fieldSet->addField(
                'status_id',
                'select',
                [
                    'name' => 'status_id',
                    'label' => __('Status'),
                    'title' => __('Status'),
                    'options' => $this->statusSource->getOptions()
                ]
            );
        }

        $fieldSet->addField(
            'order_id',
            'WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element\OrderLink',
            [
                'name' => 'order_id',
                'label' => __('Order'),
                'title' => __('Order'),
            ]
        );

        $fieldSet->addField(
            'store_id',
            'WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element\StoreName',
            [
                'name' => 'store_id',
                'label' => __('Purchased From'),
                'title' => __('Purchased From'),
            ]
        );

        $fieldSet->addField(
            'customer_id',
            'WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element\CustomerLink',
            [
                'name' => 'customer_id',
                'label' => __('Customer'),
                'title' => __('Customer'),
            ]
        );

        $fieldSet->addField(
            'updated_at',
            'WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element\DateLabel',
            [
                'name' => 'updated_at',
                'label' => __('Last Update'),
                'title' => __('Last Update'),
                'date_format' => $dateFormat
            ]
        );

        $form->setValues($rma);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('General Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('General Information');
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
}
