<?php


namespace Metagento\Faq\Controller\Adminhtml\Category;


class MassStatus extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{
    public function execute()
    {
        $categories = $this->getRequest()->getParam('category');
        $status     = $this->getRequest()->getParam('status');
        if ( $categories && $this->getRequest()->isPost() && count($categories) ) {
            foreach ( $categories as $category ) {
                try {
                    $this->_categoryFactory->create()
                                           ->load($category)
                                           ->setData('status', $status)
                                           ->save();
                    $count++;
                } catch ( \Exception $e ) {

                }
            }
        }
        $this->messageManager->addSuccessMessage(__("%1 Category(s) have been updated.", $count));
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }

}