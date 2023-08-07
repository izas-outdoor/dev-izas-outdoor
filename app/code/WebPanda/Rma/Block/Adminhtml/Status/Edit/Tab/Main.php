<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Status\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Class Main
 * @package WebPanda\Rma\Block\Adminhtml\Status\Edit\Tab
 */
class Main extends Generic implements TabInterface
{
    /**
     * @var \WebPanda\Rma\Model\Source\Email\Template\Customer
     */
    protected $templatesToCustomer;

    /**
     * @var \WebPanda\Rma\Model\Source\Email\Template\Admin
     */
    protected $templatesToAdmin;

    /**
     * @var \WebPanda\Rma\Model\Source\Email\Template\AdminNew
     */
    protected $templatesToAdminNew;

    /**
     * @var \WebPanda\Rma\Model\Source\Rma\Status
     */
    protected $statusSource;

    /**
     * Main constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \WebPanda\Rma\Model\Source\Email\Template\Customer $templatesToCustomer
     * @param \WebPanda\Rma\Model\Source\Email\Template\Admin $templatesToAdmin
     * @param \WebPanda\Rma\Model\Source\Email\Template\AdminNew $templatesToAdminNew
     * @param \WebPanda\Rma\Model\Source\Rma\Status $statusSource
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \WebPanda\Rma\Model\Source\Email\Template\Customer $templatesToCustomer,
        \WebPanda\Rma\Model\Source\Email\Template\Admin $templatesToAdmin,
        \WebPanda\Rma\Model\Source\Email\Template\AdminNew $templatesToAdminNew,
        \WebPanda\Rma\Model\Source\Rma\Status $statusSource,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->templatesToCustomer = $templatesToCustomer;
        $this->templatesToAdmin = $templatesToAdmin;
        $this->templatesToAdminNew = $templatesToAdminNew;
        $this->statusSource = $statusSource;
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

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $status = $this->_coreRegistry->registry('rma_status');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rma_status_');

        $fieldSet1 = $form->addFieldset('base_fieldset', ['legend' => __('General')]);

        if ($status->getId()) {
            $fieldSet1->addField('id', 'hidden', ['name' => 'id']);
        }

        if ($status->getId()) {
            $fieldSet1->addField(
                'name',
                'label',
                [
                    'name' => 'name',
                    'label' => __('Status Name'),
                    'title' => __('Status Name'),
                    'required' => false
                ]
            );
        } else {
            $fieldSet1->addField(
                'name',
                'text',
                [
                    'name' => 'name',
                    'label' => __('Status Name'),
                    'title' => __('Status Name'),
                    'required' => true
                ]
            );
        }

        $backgroundColor = $status->getColor() ? 'background-color: ' . $status->getColor() : '';
        $fieldSet1->addField(
            'color',
            'text',
            [
                'name' => 'color',
                'label' => __('Status Color'),
                'title' => __('Status Color'),
                'style' => $backgroundColor,
                'required' => true
            ]
        );

        $fieldSet1->addField(
            'step',
            'select',
            [
                'name' => "step",
                'required'  => true,
                'options' => $this->statusSource->getStepOptions(),
                'label' => __('Return Progress Step'),
                'title' => __('Return Progress Step'),
                'note' => __('Select the RMA Progress bar step this status should be assigned to.')
            ]
        );

        $fieldSet1->addField(
            'is_email_customer',
            'checkbox',
            [
                'name' => 'is_email_customer',
                'checked' => $status->getIsEmailCustomer(),
                'label' => __('Email to Customer'),
                'title' => __('Email to Customer'),
                'note' => __('Send Email to Customer when the RMA Request gets to this status.'),
                'after_element_js' => $this->getCustomerCheckboxJs()
            ]
        );

        foreach ($this->_storeManager->getStores() as $store) {
            $fieldSet1->addField(
                'attribute-email_to_customer_' . $store->getId(),
                'WebPanda\Rma\Block\Adminhtml\Status\Edit\Tab\Element\SelectLabel',
                [
                    'name' => "attribute[email_to_customer][" . $store->getId() . "]",
                    'store_id' => $store->getId(),
                    'required'  => true,
                    'options' => $this->templatesToCustomer->getOptions(),
                    'field_extra_attributes' => 'data-visible=is_email_customer'
                ]
            );
        }

        $fieldSet1->addField(
            'is_email_admin',
            'checkbox',
            [
                'name' => 'is_email_admin',
                'checked' => $status->getIsEmailAdmin(),
                'label' => __('Email to Admin'),
                'title' => __('Email to Admin'),
                'note' => __('Send Email to Admin when the RMA Request gets to this status.')
            ]
        );

        if ($status->getId() == 1) {
            $options = $this->templatesToAdminNew->getOptions();
        } else {
            $options = $this->templatesToAdmin->getOptions();
        }
        foreach ($this->_storeManager->getStores() as $store) {
            $fieldSet1->addField(
                'attribute-email_to_admin_' . $store->getId(),
                'WebPanda\Rma\Block\Adminhtml\Status\Edit\Tab\Element\SelectLabel',
                [
                    'name' => "attribute[email_to_admin][" . $store->getId() . "]",
                    'store_id' => $store->getId(),
                    'required'  => true,
                    'options' => $options,
                    'field_extra_attributes' => 'data-visible=is_email_admin'
                ]
            );
        }

        $fieldSet2 = $form->addFieldset('front_labels_fieldset', ['legend' => __('Frontend Label')]);

        foreach ($this->_storeManager->getStores() as $store) {
            $fieldSet2->addField(
                'attribute-frontend_label_' . $store->getId(),
                'WebPanda\Rma\Block\Adminhtml\Status\Edit\Tab\Element\FrontLabel',
                [
                    'name' => "attribute[frontend_label][" . $store->getId() . "]",
                    'store_id' => $store->getId(),
                    'required'  => true,
                ]
            );
        }

        $form->setValues($this->prepareFormValues($status));
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @param $status
     * @return mixed
     */
    protected function prepareFormValues($status)
    {
        $formValues = $status->getData();
        // make sure to set checkbox value to 1
        $formValues['is_email_customer'] = 1;
        $formValues['is_email_admin'] = 1;
        if ($status->getId()) {
            foreach ($status->getAttribute() as $attrCode => $attrValue) {
                foreach ($attrValue as $storeId => $value) {
                    $formValues['attribute-' . $attrCode . '_' . $storeId] = $value;
                }
            }
        }

        return $formValues;
    }

    /**
     * @return string
     */
    protected function getCustomerCheckboxJs()
    {
        return <<<HTML
    <script>
        require(['jquery'], function($) {
            function showField(field) {
                field.show();
                field.removeClass('ignore-validate');
            }
            function hideField(field) {
                field.hide();
                field.addClass('ignore-validate');
            }
            $(document).ready(function() {
                if (!$('#rma_status_is_email_customer').prop('checked')) {
                    var relatedFields = $('[data-visible=' + $('#rma_status_is_email_customer').prop('name') + ']');
                    hideField(relatedFields);
                }
                $('#rma_status_is_email_customer').click(function() {
                    var relatedFields = $('[data-visible=' + $(this).prop('name') + ']');
                    if ($(this).prop('checked')) {
                        showField(relatedFields);
                    } else {
                        hideField(relatedFields);
                    }
                });
                
                if (!$('#rma_status_is_email_admin').prop('checked')) {
                    var relatedFields = $('[data-visible=' + $('#rma_status_is_email_admin').prop('name') + ']');
                    hideField(relatedFields);
                }
                $('#rma_status_is_email_admin').click(function() {
                    var relatedFields = $('[data-visible=' + $(this).prop('name') + ']');
                    if ($(this).prop('checked')) {
                        showField(relatedFields);
                    } else {
                        hideField(relatedFields);
                    }
                });
            });
        });
    </script>
HTML;
    }
}
