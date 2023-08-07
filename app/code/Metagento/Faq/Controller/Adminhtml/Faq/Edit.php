<?php


namespace Metagento\Faq\Controller\Adminhtml\Faq;


class Edit extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{

    public function execute()
    {
        /** @var \Metagento\Faq\Model\Faq $category */
        $faq   = $this->_faqFactory->create();
        $faqId = $this->getRequest()->getParam('id');
        if ( $faqId ) {
            $faq->load($faqId);
            if ( !$faq->getId() ) {
                $this->messageManager->addError(__('This FAQ no longer exists.'));
                return $this->resultRedirectFactory->create()->setPath('*/*/index', ['_current' => true]);
            }
            $this->_registry->register('current_faq', $faq);
            $title = __("Edit FAQ %1", $faq->getTitle());
        } elseif ( $this->isImport() ) {
            $title = __("Import FAQ");
        } else {
            $title = __("New FAQ");
        }
        $page = $this->_resultPageFactory->create();
        $page->getConfig()->getTitle()->prepend($title);
        return $page;
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