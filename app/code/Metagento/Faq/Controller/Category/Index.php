<?php


namespace Metagento\Faq\Controller\Category;


class Index extends
    \Metagento\Faq\Controller\AbstractController
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Metagento\Faq\Model\Category $category */
        $category = $this->_categoryFactory->create()->load($id);
        if ( $category->getId() ) {
            $this->_registry->register('faq_category', $category);
        }
        $resultPage = $this->_pageFactory->create();
        if ( $category->getData('meta_description') ) {
            $resultPage->getConfig()->setDescription($category->getData('meta_description'));
        } elseif ( $this->_faqTemplate->getMetaDescription() ) {
            $resultPage->getConfig()->setDescription($this->_faqTemplate->getMetaDescription());
        }
        if ( $category->getData('meta_keywords') ) {
            $resultPage->getConfig()->setKeywords($category->getData('meta_keywords'));
        } elseif ( $this->_faqTemplate->getMetaKeywords() ) {
            $resultPage->getConfig()->setKeywords($this->_faqTemplate->getMetaKeywords());
        }
        return $resultPage;
    }


}