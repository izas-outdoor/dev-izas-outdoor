<?php


namespace Metagento\Faq\Block\Adminhtml\Faq\Edit;


class Form extends
    \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $action = $this->isImport()
            ? $this->getUrl('*/*/importProcess')
            : $this->getUrl('*/*/save', ['id' => $this->getRequest()->getParam('id')]);
        $form   = $this->_formFactory->create(
            array(
                'data' => array(
                    'id'      => 'edit_form',
                    'action'  => $action,
                    'method'  => 'post',
                    'enctype' => 'multipart/form-data',
                ),
            )
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * check if this is a import form.
     * @return mixed
     */
    public function isImport()
    {
        return $this->_coreRegistry->registry('is_import');
    }
}