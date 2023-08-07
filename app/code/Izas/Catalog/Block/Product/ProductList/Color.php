<?php
namespace Izas\Catalog\Block\Product\ProductList;

use Magento\Catalog\Block\Product\Context;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Izas\Catalog\Helper\Color as ColorHelper;

/**
 * Class Color
 * @package Izas\Catalog\Block\Product\ProductList
 */
class Color extends Template
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var ColorHelper
     */
    protected $colorHelper;

    /**
     * Related constructor.
     * @param Context $context
     * @param ColorHelper $colorHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ColorHelper $colorHelper,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->colorHelper = $colorHelper;
        parent::__construct($context, $data);
        $this->setCacheLifetime(86400);
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->registry->registry('product');
    }

    /**
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $cacheKeyInfo = parent::getCacheKeyInfo();
        $cacheKeyInfo[] = $this->getProduct()->getId();

        return $cacheKeyInfo;
    }

    /**
     * @return array
     */
    public function getColors()
    {
        $product = $this->getProduct();
        $colors = [$product->getId() => $product];
        foreach ($this->colorHelper->getCollection($this->getProduct()) as $color) {
            $colors[$color->getId()] = $color;
        }

        ksort($colors);
        return $colors;
    }

    /**
     * @return int
     */
    public function getColorsCount()
    {
        return $this->colorHelper->getColors($this->getProduct());
    }

    /**
     * @return mixed
     */
    public function getColorText()
    {
        $product = $this->getProduct();
        return $product->getResource()->getAttribute('color')->getFrontend()->getValue($product);
    }
}
