<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
// @codingStandardsIgnoreFile

namespace WebPanda\Rma\Block\Adminhtml\Status\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Class Messages
 * @package WebPanda\Rma\Block\Adminhtml\Status\Edit\Tab
 */
class Messages extends Generic implements TabInterface
{
    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Messages');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Messages');
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

        $fieldSet = $form->addFieldset('messages_fieldset', ['legend' => __('Messages')]);

        $fieldSet->addField(
            'is_message',
            'checkbox',
            [
                'name' => 'is_message',
                'checked' => $status->getIsMessage(),
                'label' => __('Adds Message to RMA'),
                'title' => __('Adds Message to RMA'),
                'note' => __('Add Message to RMA Request Thread when it gets to this status.'),
                'after_element_js' => $this->getMessagesCheckboxJs()
            ]
        );

        foreach ($this->_storeManager->getStores() as $store) {
            $fieldSet->addField(
                'attribute-message_' . $store->getId(),
                'WebPanda\Rma\Block\Adminhtml\Status\Edit\Tab\Element\MessageLabel',
                [
                    'name' => "attribute[message][" . $store->getId() . "]",
                    'store_id' => $store->getId(),
                    'required'  => true,
                    'field_extra_attributes' => 'data-visible=is_message'
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
        $formValues['is_message'] = 1;
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
    protected function getMessagesCheckboxJs()
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
                if (!$('#rma_status_is_message').prop('checked')) {
                    var relatedFields = $('[data-visible=' + $('#rma_status_is_message').prop('name') + ']');
                    hideField(relatedFields);
                }
                $('#rma_status_is_message').click(function() {
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
