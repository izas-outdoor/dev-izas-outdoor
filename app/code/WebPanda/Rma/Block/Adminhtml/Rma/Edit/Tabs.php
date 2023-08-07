<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit;

/**
 * Class Tabs
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('webpanda_rma_rma_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Return Information'));
    }
}
