<?php


namespace Metagento\Faq\Block\Adminhtml;


class Category extends
    \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {

        $this->_controller     = 'adminhtml_category';
        $this->_blockGroup     = 'Metagento_Faq';
        $this->_headerText     = __('FAQ Category Manager');
        $this->_addButtonLabel = __('New Category');
        $importUrl = $this->getUrl('faq/category/import');
        $this->addButton(
            'import',
            [
                'label' => __("Import from CSV"),
                'onclick' => "setLocation('$importUrl')",
                'class' => 'add'
            ]
        );
        parent::_construct();
    }

}