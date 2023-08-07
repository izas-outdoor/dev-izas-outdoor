<?php


namespace Metagento\Faq\Block\Adminhtml\Category\Edit\Tab;


class Content extends
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

        $category = $this->_coreRegistry->registry('current_category');

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Category Content')));
        $elements = array();

        $elements['meta_keywords'] = $fieldset->addField('meta_keywords', 'text', array(
            'label'    => __('Meta Keywords'),
            'name'     => 'meta_keywords',
            'disabled' => false,
        ));

        $elements['meta_description'] = $fieldset->addField('meta_description', 'text', array(
            'label'    => __('Meta Description'),
            'name'     => 'meta_description',
            'disabled' => false,
        ));


        if ( $category && $category->getData() ) {
            $form->setValues($category->getData());
        }
        $this->setForm($form);
        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return __('Category Information');
    }

    public function getTabTitle()
    {
        return __('Category Information');
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