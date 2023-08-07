<?php

namespace Metagento\Faq\Model\ResourceModel\Category;


class Collection extends
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
    implements
    \Magento\Framework\Data\CollectionDataSourceInterface
{
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        $this->_storeManager = $storeManager;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    protected function _construct()
    {
        $this->_init('Metagento\Faq\Model\Category', 'Metagento\Faq\Model\ResourceModel\Category');
    }

    protected function _afterLoad()
    {
        if ( $this->getSize() ) {
            foreach ( $this as $item ) {
                $item->setData('store_id', explode(',', $item->getData('store_ids')));
            }
        }
        return parent::_afterLoad();
    }

    /**
     * @param \Metagento\Faq\Model\Faq $faq
     * @return $this
     */
    public function getFaqCategories( \Metagento\Faq\Model\Faq $faq )
    {
        $faqCategoryIds = $faq->getData('category_ids');
        return $this->addFieldToFilter('category_id', array('in' => explode(',', $faqCategoryIds)))
                    ->addFieldToFilter('status', \Metagento\Faq\Model\Option\Status::STATUS_ENABLED)
                    ->setOrder('sort_order', 'ASC');
    }

    public function getCurrentStoreCategories()
    {
        $this->addFieldToFilter('store_ids', array(
            array('finset' => $this->getStore()->getId()),
            array('finset' => '0'),
        ))
             ->addFieldToFilter('status', \Metagento\Faq\Model\Option\Status::STATUS_ENABLED)
             ->setOrder('sort_order', 'ASC');
        return $this;
    }

    /**
     * get current store
     * @return \Magento\Store\Api\Data\StoreInterface
     */
    public function getStore()
    {
        return $this->_storeManager->getStore();
    }
}