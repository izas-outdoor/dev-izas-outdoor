<?php
namespace Izas\Catalog\Block\Product\View;

use Magento\Framework\Api\SortOrder;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Category
 * @package Izas\Catalog\Block\Product\View
 */
class Category extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $categoryCollection;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * Category constructor.
     * @param Context $context
     * @param CollectionFactory $categoryCollection
     * @param StoreManagerInterface $storeManager
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $categoryCollection,
        StoreManagerInterface $storeManager,
        Registry $registry,
        array $data = []
    ) {
        $this->categoryCollection = $categoryCollection;
        $this->storeManager = $storeManager;
        $this->registry = $registry;
        parent::__construct($context, $data);
        $this->setCacheLifetime(86400);
    }

    /**
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $key = parent::getCacheKeyInfo();
        $key[] = $this->registry->registry('current_product')->getId();

        return $key;
    }

    /**
     * @return \Magento\Framework\DataObject
     */
    public function getCategory()
    {
        $product = $this->registry->registry('current_product');
        return $this->categoryCollection->create()
            ->addAttributeToSelect('name')
            ->setStore($this->storeManager->getStore())
            ->addAttributeToFilter('entity_id', ['in' => $product->getCategoryIds()])
            ->addAttributeToSort('level', SortOrder::SORT_DESC)
            ->addUrlRewriteToResult()
            ->getFirstItem();
    }
}