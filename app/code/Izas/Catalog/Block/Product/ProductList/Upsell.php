<?php
namespace Izas\Catalog\Block\Product\ProductList;

use Magento\Catalog\Block\Product\Context;
use Magento\Checkout\Model\ResourceModel\Cart;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Checkout\Model\Session;
use Magento\Framework\Module\Manager;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Izas\Catalog\Helper\Cache\Color as ColorHelper;

/**
 * Class Upsell
 * @package Izas\Catalog\Block\Product\ProductList
 */
class Upsell extends \Magento\Catalog\Block\Product\ProductList\Upsell
{
    const LIMIT_COLLECTION = 4;

    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var ColorHelper
     */
    protected $colorHelper;

    /**
     * Upsell constructor.
     * @param Context $context
     * @param Cart $checkoutCart
     * @param Visibility $catalogProductVisibility
     * @param Session $checkoutSession
     * @param Manager $moduleManager
     * @param CollectionFactory $productCollectionFactory
     * @param ProductRepositoryInterface $productRepository
     * @param ColorHelper $colorHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Cart $checkoutCart,
        Visibility $catalogProductVisibility,
        Session $checkoutSession,
        Manager $moduleManager,
        CollectionFactory $productCollectionFactory,
        ProductRepositoryInterface $productRepository,
        ColorHelper $colorHelper,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->productRepository = $productRepository;
        $this->colorHelper = $colorHelper;
        parent::__construct(
            $context,
            $checkoutCart,
            $catalogProductVisibility,
            $checkoutSession,
            $moduleManager,
            $data
        );
        $this->setCacheLifetime(86400);
    }

    /**
     * @return $this
     */
    protected function _prepareData()
    {
        $product = $this->_coreRegistry->registry('product');
        /* @var $product \Magento\Catalog\Model\Product */

        $upsellCollection = $product->getUpSellProductCollection()->addAttributeToSelect(
            'required_options'
        )->setPositionOrder();

        if ($this->moduleManager->isEnabled('Magento_Checkout')) {
            $this->_addProductAttributesAndPrices($upsellCollection);
        }
        $upsellCollection->setVisibility($this->_catalogProductVisibility->getVisibleInCatalogIds());

        $upsellCollection->load();

        $ids = [$product->getId()];
        foreach ($upsellCollection as $product) {
            $ids[] = $product->getId();
            $product->setDoNotUseCategoryId(true);
        }

        $count = $upsellCollection->count();
        if ($count < self::LIMIT_COLLECTION) {
            $collection = $this->productCollectionFactory->create()
                ->addAttributeToFilter('entity_id', ['nin' => $ids]);
            if ($categoryId = $product->getCategoryId()) {
                $collection->addCategoriesFilter(['eq' => $categoryId]);
            }

//            if ($color = $product->getColorFilter()) {
//                $collection->addAttributeToFilter('color_filter', $color);
//            }

            $collection->setVisibility($this->_catalogProductVisibility->getVisibleInCatalogIds());
            $this->_addProductAttributesAndPrices($collection);
            $collection->getSelect()->limit(self::LIMIT_COLLECTION - $count)->orderRand();

            foreach ($collection as $item) {
                $item->setDoNotUseCategoryId(true);
                $upsellCollection->addItem($item);
            }
        }

        $this->_itemCollection = $upsellCollection;
        return $this;
    }

    /**
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $cacheKeyInfo = parent::getCacheKeyInfo();
        $cacheKeyInfo[] = $this->_coreRegistry->registry('product')->getId();

        return $cacheKeyInfo;
    }
}