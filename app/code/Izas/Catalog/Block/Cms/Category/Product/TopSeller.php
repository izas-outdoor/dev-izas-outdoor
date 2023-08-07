<?php

namespace Izas\Catalog\Block\Cms\Category\Product;

use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\Url\Helper\Data;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Customer\Model\SessionFactory;
use Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory as BestSellersCollectionFactory;

/**
 * Class ListProduct
 * @package Izas\Catalog\Block\Cms\Category\Product
 */
class TopSeller extends \Wetrust\Catalog\Block\Product\ListProduct
{
    const LIMIT_CATEGORY_COLLECTION = 3;

    /**
     * @var CollectionFactory $collectionFactory
     */
    protected $collectionFactory;

    /**
     * @var array $productsByCategory
     */
    protected $productsByCategory = [];
    /**
     * @var array $collectionIds
     */
    protected $collectionIds = [];

    /**
     * @var BestSellersCollectionFactory
     */
    protected $_bestSellersCollectionFactory;

    /**
     * ListProduct constructor.
     * @param Context $context
     * @param PostHelper $postDataHelper
     * @param Resolver $layerResolver
     * @param CategoryRepositoryInterface $categoryRepository
     * @param Data $urlHelper
     * @param CollectionFactory $collectionFactory
     * @param SessionFactory $customerSession
     * @param BestSellersCollectionFactory $bestSellersCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        PostHelper $postDataHelper,
        Resolver $layerResolver,
        CategoryRepositoryInterface $categoryRepository,
        Data $urlHelper,
        CollectionFactory $collectionFactory,
        SessionFactory $customerSession,
        BestSellersCollectionFactory $bestSellersCollectionFactory,
        array $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->_bestSellersCollectionFactory = $bestSellersCollectionFactory;
        $this->setTemplate('Izas_Catalog::cms/category/product/top-sellers.phtml');
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $customerSession, $data);
    }


    public function getTopSellingProducts()
    {
        $productIds = [];
        $bestSellers = $this->_bestSellersCollectionFactory->create()
            ->setPeriod('month');
        foreach ($bestSellers as $product) {
            $productIds[] = $product->getProductId();
        }


        $collection = $this->collectionFactory->create();
        /** Configurable products from simple product added as well into best seller list */
        $_conn = $collection->getResource()->getConnection();
        $select = $_conn->select('*')
            ->from($collection->getTable('sales_bestsellers_aggregated_yearly AS sbay'))
            ->joinLeft(
                ['cpsl' => $collection->getTable('catalog_product_super_link')],
                'sbay.product_id = cpsl.product_id',
                ['parent_id']
            )
            ->where('cpsl.parent_id IS NOT NULL')
            ->where('sbay.product_id in (' . implode(',', $productIds) . ')');
        $result = $_conn->fetchAll($select);
        $configurableParents = array();
        foreach ($result as $item) {
            $configurableParents[$item['parent_id']] = $item['parent_id'];
        }

        $collection
            ->addIdFilter($configurableParents)
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addAttributeToSelect('*')
            ->setPageSize(3);

        return $collection;
    }

}
