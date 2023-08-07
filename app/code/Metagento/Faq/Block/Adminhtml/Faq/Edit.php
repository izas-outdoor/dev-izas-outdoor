<?php


namespace Metagento\Faq\Block\Adminhtml\Faq;


class Edit extends
    \Magento\Backend\Block\Widget\Form\Container
{

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     *
     */
    protected function _construct()
    {
        $this->_objectId   = 'id';
        $this->_blockGroup = 'Metagento_Faq';
        $this->_controller = 'adminhtml_faq';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save FAQ'));
        $this->buttonList->update('delete', 'label', __('Delete FAQ'));
        $this->buttonList->add(
            'saveandcontinue',
            array(
                'label'          => __('Save and Continue Edit'),
                'class'          => 'save',
                'data_attribute' => array(
                    'mage-init' => array('button' => array('event' => 'saveAndContinueEdit', 'target' => '#edit_form')),
                ),
            ),
            -100
        );

        if ( $this->isImport() ) {
            $this->removeButton('saveandcontinue');
            $this->removeButton('delete');
            $this->removeButton('reset');
            $this->buttonList->update('save', 'label', __('Import FAQ'));
        }
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ( $this->_registry->registry('current_faq')->getId() ) {
            return __("Edit FAQ '%1'", $this->escapeHtml($this->_registry->registry('current_faq')->getData('title')));
        } elseif ( $this->isImport() ) {
            return __('Import FAQ');
        } else {
            return __('New FAQ');
        }
    }

    /**
     * check if this is a import form.
     * @return mixed
     */
    public function isImport()
    {
        return $this->_registry->registry('is_import');
    }
}