<?php


namespace Metagento\Faq\Controller\Adminhtml\Faq;


class Delete extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $faqId          = $this->getRequest()->getParam('id');
        if ( !$faqId ) {
            return $resultRedirect->setPath('*/*/');
        }
        if ( $faqId ) {
            $model = $this->_faqFactory->create()->load($faqId);
        }
        try {
            $model->delete();
            $this->messageManager->addSuccess(__('FAQ was successfully deleted'));
        } catch ( \Exception $e ) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['id' => $faqId]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}