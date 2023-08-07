<?php


namespace Metagento\Faq\Controller\Adminhtml\Faq;


class Save extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $faqId          = (int)$this->getRequest()->getParam('faq_id');
        $data           = $this->getRequest()->getPostValue();
        if ( !$data ) {
            return $resultRedirect->setPath('*/*/');
        }

        if ( $faqId ) {
            $model = $this->_faqFactory->create()->load($faqId);
        } else {
            $model = $this->_faqFactory->create();
        }
        $model->setData($data);
        if ( is_array($data['category_ids']) ) {
            $model->setData('category_ids', implode(',', $data['category_ids']));
        }
        try {
            $model->save();
            $model->getResource()->saveUrlKey($model);
            $this->messageManager->addSuccess(__('Faq was successfully saved'));
        } catch ( \Exception $e ) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        if ( $this->getRequest()->getParam('back') == 'edit' ) {
            return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}