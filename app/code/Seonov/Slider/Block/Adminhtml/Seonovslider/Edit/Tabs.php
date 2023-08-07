<?php
namespace Seonov\Slider\Block\Adminhtml\Seonovslider\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('checkmodule_seonovslider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Seonovslider Information'));
    }
}