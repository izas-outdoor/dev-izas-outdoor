<?php


namespace Metagento\Faq\Controller\Adminhtml\Category;


class Save extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $categoryId     = (int)$this->getRequest()->getParam('category_id');
        $data           = $this->getRequest()->getPostValue();
        if ( !$data ) {
            return $resultRedirect->setPath('*/*/');
        }

        if ( $categoryId ) {
            $model = $this->_categoryFactory->create()->load($categoryId);
        } else {
            $model = $this->_categoryFactory->create();
        }
        $model->setData($data);
        if ( is_array($data['store_ids']) ) {
            $model->setData('store_ids', implode(',', $data['store_ids']));
        }
        try {
            $model->save();
            $model->getResource()->saveUrlKey($model);
            $this->messageManager->addSuccess(__('Category was successfully saved'));
        } catch ( \Exception $e ) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        if ( $this->getRequest()->getParam('back') == 'edit' ) {
            return $resultRedirect->setPath('*/*/edit', ['id' => $model->getCategoryId()]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}