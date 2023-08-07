<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Status\Edit;

/**
 * Class Form
 * @package WebPanda\Rma\Block\Adminhtml\Status\Edit
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('rma_status_form');
        $this->setTitle(__('Status Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' =>
                    [
                        'id' => 'edit_form',
                        'action' => $this->getUrl('rma_admin/status/save'),
                        'method' => 'post'
                    ]
            ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
