<?php


namespace Metagento\Faq\Block\Adminhtml\Faq\Edit\Tab;


class General extends
    \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Metagento\Faq\Model\Option\Status $status,
        \Metagento\Faq\Model\Option\Category $categoryOption,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_status         = $status;
        $this->_categoryOption = $categoryOption;
        $this->_systemStore    = $systemStore;
    }


    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {

        $faq = $this->_coreRegistry->registry('current_faq');

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('FAQ Information')));

        if ( $faq && $faq->getId() ) {
            $fieldset->addField('faq_id', 'hidden', array('name' => 'faq_id'));
        }

        $elements = array();

        $elements['title'] = $fieldset->addField('title', 'text', array(
            'label'    => __('Title'),
            'name'     => 'title',
            'disabled' => false,
            'required' => true,
        ));

        $elements['url_key'] = $fieldset->addField('url_key', 'text', array(
            'label'    => __('Url Key'),
            'name'     => 'url_key',
            'disabled' => false,
        ));

        $elements['category_ids'] = $fieldset->addField('category_ids', 'multiselect', array(
                                                                          'label'    => __('Categories'),
                                                                          'title'    => __('Categories'),
                                                                          'name'     => 'category_ids[]',
                                                                          'required' => true,
                                                                          'values'   => $this->_categoryOption->toOptionHash(),
                                                                      )
        );

        $elements['sort_order'] = $fieldset->addField('sort_order', 'text', array(
                                                                      'name'     => 'sort_order',
                                                                      'required' => true,
                                                                      'label'    => __('Sort Order'),
                                                                      'title'    => __('Sort Order'),
                                                                      'class'    => 'validate-zero-or-greater',
                                                                  )
        );

        $elements['most_frequently'] = $fieldset->addField('most_frequently', 'select', array(
                                                                                'label'    => __('Is Most Frequently'),
                                                                                'title'    => __('Is Most Frequently'),
                                                                                'name'     => 'most_frequently',
                                                                                'required' => false,
                                                                                'options'  => array(
                                                                                    '0' => __("No"),
                                                                                    '1' => __("Yes"),
                                                                                ),
                                                                            )
        );

        $elements['status'] = $fieldset->addField('status', 'select', array(
                                                              'label'    => __('Status'),
                                                              'title'    => __('Status'),
                                                              'name'     => 'status',
                                                              'required' => false,
                                                              'options'  => $this->_status->toOptionArray(),
                                                          )
        );
        if ( $faq && $faq->getData() ) {
            $form->setValues($faq->getData());
        }
        $this->setForm($form);
        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return __('FAQ Information');
    }

    public function getTabTitle()
    {
        return __('FAQ Information');
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