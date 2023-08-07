<?php


namespace Metagento\Faq\Block\Adminhtml\Category\Edit\Tab;


class Import extends
    \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Metagento\Faq\Model\Option\Status $status,
        \Metagento\Faq\Model\Option\Category $categoryOption,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Cms\Model\Wysiwyg\Config $config,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_status         = $status;
        $this->_categoryOption = $categoryOption;
        $this->_systemStore    = $systemStore;
        $this->_wysiwygConfig  = $config;
    }


    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Import Category')));
        $elements = array();

        $sampleDownloadUrl       = $this->getUrl('faq/category/sampleDownload');
        $elements['file_csv'] = $fieldset->addField('file_csv', 'file', array(
            'label'    => __('Category CSV file'),
            'name'     => 'file_csv',
            'required' => true,
            'note'     => "You can download sample csv file <a href='$sampleDownloadUrl'>here</a>",
        ));

        $this->setForm($form);
        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return __('Import Category');
    }

    public function getTabTitle()
    {
        return __('Import Category');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

}