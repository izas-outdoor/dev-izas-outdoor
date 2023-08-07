<?php


namespace Metagento\Faq\Block\Adminhtml\Category\Edit\Tab;


class General extends
    \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Metagento\Faq\Model\Option\Status $status,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_status      = $status;
        $this->_systemStore = $systemStore;
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
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Category Information')));

        if ( $category && $category->getId() ) {
            $fieldset->addField('category_id', 'hidden', array('name' => 'category_id'));
        }

        $elements = array();

        $elements['name'] = $fieldset->addField('name', 'text', array(
            'label'    => __('Name'),
            'class'    => 'required-entry',
            'required' => true,
            'name'     => 'name',
            'disabled' => false,
        ));

        $elements['url_key'] = $fieldset->addField('url_key', 'text', array(
            'label'    => __('Url Key'),
            'name'     => 'url_key',
            'disabled' => false,
        ));

        if ( !$this->_storeManager->isSingleStoreMode() ) {
            $field    = $fieldset->addField(
                'store_ids',
                'multiselect',
                [
                    'name'     => 'store_ids[]',
                    'label'    => __('Store View'),
                    'title'    => __('Store View'),
                    'required' => true,
                    'values'   => $this->_systemStore->getStoreValuesForForm(false, true),
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'store_ids',
                'hidden',
                ['name' => 'store_ids[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
        }

        $elements['sort_order'] = $fieldset->addField('sort_order', 'text', array(
                                                                      'name'     => 'sort_order',
                                                                      'required' => true,
                                                                      'label'    => __('Sort Order'),
                                                                      'title'    => __('Sort Order'),
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