<?php
namespace Izas\Catalog\Block\Product\ProductList;

use Magento\Catalog\Block\Product\Context;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;

/**
 * Class OutOfStock
 * @package Izas\Catalog\Block\Product\ProductList
 */
class OutOfStock extends Template
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
        array $data = []
    ) {
        $this->registry = $registry;
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

}
