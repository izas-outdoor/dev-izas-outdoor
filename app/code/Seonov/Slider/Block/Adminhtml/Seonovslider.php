<?php
namespace Seonov\Slider\Block\Adminhtml;
class Seonovslider extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
		
        $this->_controller = 'adminhtml_seonovslider';/*block grid.php directory*/
        $this->_blockGroup = 'Seonov_Slider';
        $this->_headerText = __('Seonovslider');
        $this->_addButtonLabel = __('Add New Entry'); 
        parent::_construct();
		
    }
}
