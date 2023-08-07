<?php
namespace Izas\Catalog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\Product;
use Izas\Catalog\Helper\Cache\Color as ColorCache;
use Magento\Framework\Registry;
use Magento\Swatches\Model\ResourceModel\Swatch\CollectionFactory as SwatchCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Helper\ImageFactory;

/**
 * Class Color
 * @package Izas\Catalog\Helper
 */
class Color extends AbstractHelper
{
    const WHITE = '#ffffff';

    /**
     * @var ColorCache
     */
    protected $cache;

    /**
     * @var Visibility
     */
    protected $catalogProductVisibility;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var SwatchCollectionFactory
     */
    protected $swatchCollectionFactory;

    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var ImageFactory
     */
    protected $imageFactory;

    /**
     * Color constructor.
     * @param Context $context
     * @param ColorCache $cache
     * @param Visibility $catalogProductVisibility
     * @param Registry $registry
     * @param SwatchCollectionFactory $swatchCollectionFactory
     * @param CollectionFactory $productCollectionFactory
     * @param ImageFactory $imageFactory
     */
    public function __construct(
        Context $context,
        ColorCache $cache,
        Visibility $catalogProductVisibility,
        Registry $registry,
        SwatchCollectionFactory $swatchCollectionFactory,
        CollectionFactory $productCollectionFactory,
        ImageFactory $imageFactory
    ) {
        $this->cache = $cache;
        $this->catalogProductVisibility = $catalogProductVisibility;
        $this->coreRegistry = $registry;
        $this->swatchCollectionFactory = $swatchCollectionFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->imageFactory = $imageFactory;
        parent::__construct($context);
    }

    /**
     * @param $product
     * @return mixed
     */
    public function getCollection($product)
    {
        $sku = substr($product->getSku(), 0, 10);
        $collection = $this->productCollectionFactory->create()
            ->addAttributeToSelect(['thumbnail', 'small_image', 'base_image','image'])
            ->addAttributeToFilter('sku', ['like' => $sku . "%"])
            ->addAttributeToFilter('status', '1')
            ->addAttributeToFilter('type_id', 'configurable')
            ->addStoreFilter();

        $collection->setVisibility($this->catalogProductVisibility->getVisibleInCatalogIds());
        $colors = [];
        foreach ($collection as $item) {
            $item->setDoNotUseCategoryId(true);
            $colors[] = $item;
        }

        $this->saveInCache($product->getId(), count($colors));

        return $collection;
    }

    /**
     * @param $productId
     * @param $value
     * @return $this
     */
    protected function saveInCache($productId, $value)
    {
        $cacheKey = $this->cache->getCacheId($productId);
        $cacheTags[] = Product::CACHE_TAG . '_' . $productId;
        $this->cache->save($value, $cacheKey, $cacheTags);

        return $this;
    }

    /**
     * @param $product
     * @return int
     */
    public function getColors($product)
    {
        $cacheKey = $this->cache->getCacheId($product->getId());
        if ($data = $this->cache->load($cacheKey)) {
            $colors = $data;
        } else {
            $this->getCollection($product);
            $colors = $this->cache->load($cacheKey);
        }

        return $colors;
    }

    /**
     * @param $productId
     * @return \Magento\Framework\DataObject
     */
    protected function getProduct($productId)
    {
        return  $this->productCollectionFactory->create()
            ->addAttributeToSelect('color')
            ->addFieldToFilter('entity_id', ['eq' => $productId])
            ->getFirstItem();
    }

    /**
     * @param $productId
     * @return \Magento\Framework\DataObject
     */
    public function getSwatch($productId)
    {
        $optionId = $this->getProduct($productId)->getColor();  
        $swatch = $this->swatchCollectionFactory
            ->create()
            ->addFieldToFilter('option_id', $optionId)
            ->getFirstItem();

        if ($swatch->getValue() == self::WHITE) {
            $swatch->setClass('white');
        }

        return $swatch;
    }

    /**
     * @param $product
     * @return string
     */
    public function getColorImage($product)
    {
        return $this->imageFactory->create()
            ->init($product, 'small_image')
            ->setImageFile($product->getImage())
            ->resize(50, 50)
            ->getUrl();
    }
}
