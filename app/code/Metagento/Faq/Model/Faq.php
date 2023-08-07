<?php

namespace Metagento\Faq\Model;


use Magento\Framework\Model\AbstractModel;

class Faq extends
    AbstractModel
{

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Metagento\Faq\Model\ResourceModel\Faq $resource,
        \Metagento\Faq\Model\CategoryFactory $categoryFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\UrlRewrite\Model\ResourceModel\UrlRewriteCollectionFactory $urlRewriteCollectionFactory,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \Metagento\Faq\Model\ResourceModel\Faq\Collection $resourceCollection,
        array $data = []
    ) {
        $this->_categoryFactory             = $categoryFactory;
        $this->_storeManager                = $storeManager;
        $this->_urlRewriteCollectionFactory = $urlRewriteCollectionFactory;
        $this->_filterProvider              = $filterProvider;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init('Metagento\Faq\Model\ResourceModel\Faq');
    }

    public function afterSave()
    {
        return parent::afterSave();
    }

    public function getContent()
    {
        $content = $this->getData('content');
        return $this->_filterProvider->getBlockFilter()
                                     ->setStoreId($this->_storeManager->getStore()->getId())
                                     ->filter($content);
    }

    /**
     *
     * @return array
     */
    public function getStoreIds()
    {
        /** @var \Metagento\Faq\Model\ResourceModel\Category\Collection $categories */
        $categories = $this->_categoryFactory->create()->getCollection();
        $categories->getFaqCategories($this);
        $storeIds = array();
        foreach ( $categories as $category ) {
            $storeIds = array_merge($storeIds, explode(',', $category->getData('store_ids')));
        }
        return array_unique($storeIds);
    }

    /**
     * @return array
     */
    public function getRealStoreIds()
    {
        $storeIds = $this->getStoreIds();
        if ( in_array('0', $storeIds) ) {
            $storeIds = array();
            $stores   = $this->_storeManager->getStores();
            foreach ( $stores as $store ) {
                if ( $store->getId() ) {
                    $storeIds[] = $store->getId();
                }
            }
        }
        return $storeIds;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        $url     = '';
        $id      = $this->getId();
        $storeId = $this->_storeManager->getStore()->getId();
        /** check url rewrite first */
        $urlRewrite = $this->_urlRewriteCollectionFactory
            ->create()
            ->addFieldToFilter('entity_type', 'faq')
            ->addFieldToFilter('entity_id', $id)
            ->addFieldToFilter('store_id', $storeId);
        if ( $urlRewrite->getSize() ) {
            $urlRewrite = $urlRewrite->getFirstItem();
            $url        = $this->_storeManager->getStore()->getBaseUrl();
            $url .= $urlRewrite->getRequestPath();
        } else {
            $url = $this->_storeManager->getStore()->getUrl('faq/faq/index', array('id' => $id));
        }
        return $url;
    }


}