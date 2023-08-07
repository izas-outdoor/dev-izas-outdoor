<?php


namespace Metagento\Faq\Controller\Adminhtml\Category;


class Delete extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $categoryId     = $this->getRequest()->getParam('id');
        if ( !$categoryId ) {
            return $resultRedirect->setPath('*/*/');
        }
        if ( $categoryId ) {
            $model = $this->_categoryFactory->create()->load($categoryId);
        }
        try {
            $model->delete();
            $this->messageManager->addSuccess(__('Category was successfully deleted'));
        } catch ( \Exception $e ) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}