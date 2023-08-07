<?php


namespace Metagento\Faq\Controller\Adminhtml\Faq;


class MassDelete extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{
    public function execute()
    {
        $count = 0;
        $faqs  = $this->getRequest()->getParam('faq');
        if ( $faqs && $this->getRequest()->isPost() && count($faqs) ) {
            foreach ( $faqs as $faq ) {
                try {
                    $this->_categoryFactory->create()->load($faq)->delete();
                    $count++;
                } catch ( \Exception $e ) {

                }
            }
        }
        $this->messageManager->addSuccessMessage(__("%1 FAQ(s) have been deleted.", $count));
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }

}