<?php

namespace Metagento\Faq\Model\ResourceModel\Faq;


class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
    implements
    \Magento\Framework\Data\CollectionDataSourceInterface
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Metagento\Faq\Model\Faq', 'Metagento\Faq\Model\ResourceModel\Faq');
    }

    /**
     * @return $this
     */
    public function getMostFaqs()
    {
        return $this->addFieldToFilter('most_frequently', '1')
                    ->addFieldToFilter('status', \Metagento\Faq\Model\Option\Status::STATUS_ENABLED)
                    ->setOrder('sort_order', 'ASC');
    }

    /**
     * @param \Metagento\Faq\Model\Category $category
     * @return $this
     */
    public function filterByCategory( \Metagento\Faq\Model\Category $category )
    {
        $categoryId = $category->getId();
        return $this->addFieldToFilter('category_ids', array('finset' => $categoryId))
                    ->addFieldToFilter('status', \Metagento\Faq\Model\Option\Status::STATUS_ENABLED)
                    ->setOrder('sort_order', 'ASC');
    }
}