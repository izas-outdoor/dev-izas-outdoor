<?php

namespace Metagento\Faq\Model;


class Category extends
    \Magento\Framework\Model\AbstractModel
{
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Metagento\Faq\Model\ResourceModel\Category $resource,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\UrlRewrite\Model\ResourceModel\UrlRewriteCollectionFactory $urlRewriteCollectionFactory,
        \Metagento\Faq\Model\ResourceModel\Category\Collection $resourceCollection,
        array $data = []
    ) {
        $this->_storeManager                = $storeManager;
        $this->_urlRewriteCollectionFactory = $urlRewriteCollectionFactory;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }


    public function _construct()
    {
        $this->_init('Metagento\Faq\Model\ResourceModel\Category');
    }

    public function afterSave()
    {
        return parent::afterSave();
    }

    /**
     * @return array
     */
    public function getRealStoreIds()
    {
        $storeIds = $this->getStoreIds();
        if ( !is_array($storeIds) ) {
            $storeIds = array($storeIds);
        }
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
        $url = '';
        $id  = $this->getId();
        $storeId = $this->_storeManager->getStore()->getId();
        /** check url rewrite first */
        $urlRewrite = $this->_urlRewriteCollectionFactory
            ->create()
            ->addFieldToFilter('entity_type', 'faq_category')
            ->addFieldToFilter('entity_id', $id)
            ->addFieldToFilter('store_id', $storeId);
        if ( $urlRewrite->getSize() ) {
            $urlRewrite = $urlRewrite->getFirstItem();
            $url        = $this->_storeManager->getStore()->getBaseUrl();
            $url .= $urlRewrite->getRequestPath();
        } else {
            $url = $this->_storeManager->getStore()->getUrl('faq/category/index', array('id' => $id));
        }
        return $url;
    }


}