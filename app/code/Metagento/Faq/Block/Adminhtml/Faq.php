<?php


namespace Metagento\Faq\Block\Adminhtml;


class Faq extends
    \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller     = 'adminhtml_faq';
        $this->_blockGroup     = 'Metagento_Faq';
        $this->_headerText     = __('FAQ Manager');
        $this->_addButtonLabel = __('New FAQ');

        $importUrl = $this->getUrl('faq/faq/import');
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