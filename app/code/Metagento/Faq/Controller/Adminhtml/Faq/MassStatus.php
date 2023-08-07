<?php


namespace Metagento\Faq\Controller\Adminhtml\Faq;


class MassStatus extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{
    public function execute()
    {
        $faqs = $this->getRequest()->getParam('faq');
        $status     = $this->getRequest()->getParam('status');
        if ( $faqs && $this->getRequest()->isPost() && count($faqs) ) {
            foreach ( $faqs as $faq ) {
                try {
                    $this->_faqFactory->create()
                                           ->load($faq)
                                           ->setData('status', $status)
                                           ->save();
                    $count++;
                } catch ( \Exception $e ) {

                }
            }
        }
        $this->messageManager->addSuccessMessage(__("%1 FAQ(s) have been updated.", $count));
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }

}