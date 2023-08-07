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

/**
 * Class ListProduct
 * @package Izas\Catalog\Block\Cms\Category\Product
 */
class ListCategoryProduct extends \Wetrust\Catalog\Block\Product\ListProduct
{
    const LIMIT_CATEGORY_COLLECTION = 15;

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
     * ListProduct constructor.
     * @param Context $context
     * @param PostHelper $postDataHelper
     * @param Resolver $layerResolver
     * @param CategoryRepositoryInterface $categoryRepository
     * @param Data $urlHelper
     * @param CollectionFactory $collectionFactory
     * @param SessionFactory $customerSession
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
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->setTemplate('Izas_Catalog::cms/category/product/listcategoryproduct.phtml');
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $customerSession, $data);
    }

    /**
     * @codingStandardsIgnoreStart
     * @return $this|\Magento\Catalog\Model\ResourceModel\Product\Collection|\Magento\Eav\Model\Entity\Collection\AbstractCollection
     */
    protected function _getProductCollection()
    {
        if ($this->_productCollection === null) {
            $this->_productCollection = $this->initCollection();
        }

        return $this->_productCollection;
    }
    /**
     * @codingStandardsIgnoreEnd
     * @return array
     */
    public function getCategoriesCollection()
    {
        if ($this->_productCollection == null) {
            $this->_getProductCollection();
        }

        return $this->productsByCategory;
    }

    /**
     * @param $originalCollection
     * @param $category
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    private function getCategoryCollection($originalCollection, $category)
    {
        $collection = $this->collectionFactory
            ->create()
            ->setPageSize(self::LIMIT_CATEGORY_COLLECTION)
            ->addCategoryFilter($category)
            ->addAttributeToSelect('*');

        // if($this->getRandomized()) {
        //     $collection->getSelect()->orderRand();
        // } else {
        //     $collection->getSelect()->order('cat_index.position ASC');
        //     $collection->getSelect()->order('e.entity_id ASC');
        // }
             $collection->getSelect()->orderRand();
        foreach ($collection as $product) {
            $categoryId = $category->getId();
            $this->productsByCategory[$categoryId]['name'] = $category->getName();
            $this->productsByCategory[$categoryId]['url'] = $category->getUrl();
            $this->productsByCategory[$categoryId]['products'][$product->getId()] = $product;

            if (!isset($this->collectionIds[$product->getId()])) {
                $this->collectionIds[$product->getId()] = true;
                $originalCollection->addItem($product);
            }
        }

        return $collection;
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection|ListProduct
     */
    private function initCollection()
    {
        $collection =  $this->collectionFactory->create();
        if ($categories = $this->getCategories()) {
            foreach ($categories as $categoryId) {
                try {
                    $category = $this->categoryRepository->get($categoryId);
                } catch (NoSuchEntityException $e) {
                    $category = null;
                }

                if ($category) {
                    $collection = $this->getCategoryCollection($collection, $category);
                }
            }
        }

        $this->_eventManager->dispatch(
            'catalog_block_product_list_collection',
            ['collection' => $collection]
        );

        return $collection;
    }

    /**
     * @param $categories
     * @return $this
     */
    public function setCategories($categories)
    {
        $this->setData('categories', explode(',', $categories));
        return $this;
    }
    
}