<?php


namespace Metagento\Faq\Block\Content;


class Faqlist extends
    \Metagento\Faq\Block\Content
{
    protected function _prepareLayout()
    {
        $this->setTemplate('faq/faqlist.phtml');
    }

    /**
     * get current store
     * @return \Magento\Store\Api\Data\StoreInterface
     */
    public function getStore()
    {
        return $this->_storeManager->getStore();
    }

    public function getFaqs()
    {
        $category = $this->getSelectedCategory();
        if ( $category ) {
            return $this->getFaqByCategory($category);
        }
        return $this->getMostFaqs();
    }

    public function getFaqByCategory( \Metagento\Faq\Model\Category $category )
    {
        /** @var \Metagento\Faq\Model\ResourceModel\Faq\Collection $collection */
        $collection = $this->_faqFactory->create()->getCollection();
        return $collection->filterByCategory($category);
    }
}