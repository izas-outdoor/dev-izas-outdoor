<?php


namespace Metagento\Faq\Controller\Faq;


class Index extends
    \Metagento\Faq\Controller\AbstractController
{

    public function execute()
    {
        $this->registerFaq();
        $this->registerCategory();
        $faq        = $this->_registry->registry('faq');
        $resultPage = $this->_pageFactory->create();
        if ( $faq && $faq->getData('meta_description') ) {
            $resultPage->getConfig()->setDescription($faq->getData('meta_description'));
        } elseif ( $this->_faqTemplate->getMetaDescription() ) {
            $resultPage->getConfig()->setDescription($this->_faqTemplate->getMetaDescription());
        }
        if ( $faq && $faq->getData('meta_keywords') ) {
            $resultPage->getConfig()->setKeywords($faq->getData('meta_keywords'));
        } elseif ( $this->_faqTemplate->getMetaKeywords() ) {
            $resultPage->getConfig()->setKeywords($this->_faqTemplate->getMetaKeywords());
        }
        return $resultPage;
    }

    public function registerFaq()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Metagento\Faq\Model\Faq $faq */
        $faq = $this->_faqFactory->create()->load($id);
        if ( $faq->getId() ) {
            $this->_registry->register('faq', $faq);
        }
        return $this;
    }

    public function registerCategory()
    {
        if ( $faq = $this->_registry->registry('faq') ) {
            $categoryIds = $faq->getData('category_ids');
            $categoryIds = explode(',', $categoryIds);
            foreach ( $categoryIds as $categoryId ) {
                $category = $this->_categoryFactory->create()->load($categoryId);
                if ( $category->getId() ) {
                    $this->_registry->register('faq_category', $category);
                    return $this;
                }
            }
        }
        return $this;
    }

}