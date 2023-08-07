<?php


namespace Metagento\Faq\Controller\Adminhtml\Category;


class Edit extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{

    public function execute()
    {
        /** @var \Metagento\Faq\Model\Category $category */
        $category   = $this->_categoryFactory->create();
        $categoryId = $this->getRequest()->getParam('id');
        if ( $categoryId ) {
            $category->load($categoryId);
            if ( !$category->getId() ) {
                $this->messageManager->addError(__('This category no longer exists.'));
                return $this->resultRedirectFactory->create()->setPath('*/*/index', ['_current' => true]);
            }
            $this->_registry->register('current_category', $category);
            $title = __("Edit Category %1", $category->getName());
        } elseif ( $this->isImport() ) {
            $title = __("Import Category");
        } else {
            $title = __("New Category");
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