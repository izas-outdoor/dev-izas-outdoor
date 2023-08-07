<?php


namespace Metagento\Faq\Controller\Adminhtml\Category;


class MassDelete extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{
    public function execute()
    {
        $count      = 0;
        $categories = $this->getRequest()->getParam('category');
        if ( $categories && $this->getRequest()->isPost() && count($categories) ) {
            foreach ( $categories as $category ) {
                try {
                    $this->_categoryFactory->create()->load($category)->delete();
                    $count++;
                } catch ( \Exception $e ) {

                }
            }
        }
        $this->messageManager->addSuccessMessage(__("%1 Category(s) have been deleted.", $count));
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }

}