<?php
namespace Izas\Catalog\Block\Product\View;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;

/**
 * Class Attributes
 * @package Izas\Catalog\Block\Product\View
 */
class Attributes extends Template
{
    /**
     * @var \Magento\Catalog\Model\Product
     */
    protected $product;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * Attributes constructor.
     * @param Template\Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->registry = $registry;
        parent::__construct($context, $data);
        $this->setCacheLifetime(86400);
    }

    /**
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $cacheKeyInfo = parent::getCacheKeyInfo();
        $cacheKeyInfo[] = $this->registry->registry('product')->getId();

        return $cacheKeyInfo;
    }

    /**
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        if (is_null($this->product)) {
            $this->product = $this->registry->registry('product');
        }
        return $this->product;
    }
}