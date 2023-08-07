<?php

namespace Omnisend\Omnisend\Block\Product\View;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Block\Product\View\Description as BaseDescription;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Omnisend\Omnisend\Helper\PriceHelper;
use Omnisend\Omnisend\Helper\ProductImageHelper;
use Omnisend\Omnisend\Helper\ProductUrlHelper;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Json\Helper\Data as JsonHelper;

class Description extends BaseDescription
{
    /**
     * @var PriceCurrencyInterface
     */
    private $priceCurrency;

    /**
     * @var PriceHelper
     */
    private $priceHelper;

    /**
     * @var ProductImageHelper
     */
    private $productImageHelper;

    /**
     * @var ProductUrlHelper
     */
    private $productUrlHelper;

    /**
     * @var JsonHelper
     */
    private $jsonHelper;

    /**
     * Description constructor.
     * @param Context $context
     * @param Registry $registry
     * @param PriceCurrencyInterface $priceCurrency
     * @param PriceHelper $priceHelper
     * @param ProductImageHelper $productImageHelper
     * @param ProductUrlHelper $productUrlHelper
     * @param JsonHelper $jsonHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PriceCurrencyInterface $priceCurrency,
        PriceHelper $priceHelper,
        ProductImageHelper $productImageHelper,
        ProductUrlHelper $productUrlHelper,
        JsonHelper $jsonHelper,
        array $data = []
    ) {
        $this->priceCurrency = $priceCurrency;
        $this->priceHelper = $priceHelper;
        $this->productImageHelper = $productImageHelper;
        $this->productUrlHelper = $productUrlHelper;
        $this->jsonHelper = $jsonHelper;

        parent::__construct($context, $registry, $data);
    }

    /**
     * @return string
     */
    public function getPriceCurrencyCode()
    {
        return $this->priceCurrency->getCurrency()->getCurrencyCode();
    }

    /**
     * @param ProductInterface $product
     * @return string
     */
    public function getProductImageUrl(ProductInterface $product)
    {
        return $this->productImageHelper->getImageUrl($product, $this->_storeManager->getStore()->getId());
    }

    /**
     * @param ProductInterface $product
     * @return string
     */
    public function getProductPageUrl(ProductInterface $product)
    {
        return $this->productUrlHelper->getProductUrl($product->getId(), $this->_storeManager->getStore()->getId());
    }

    /**
     * @return int
     */
    public function getFinalPrice()
    {
        return $this->getPriceInCents($this->getProduct()->getFinalPrice());
    }

    /**
     * @return int
     */
    public function getOldPrice()
    {
        $oldPrice = $this->getProduct()->getPriceInfo()->getPrice('regular_price')->getValue();

        return $this->getPriceInCents($oldPrice);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->jsonHelper->jsonEncode(strip_tags($this->getProduct()->getDescription()));
    }

    /**
     * @param $price
     * @return int
     */
    protected function getPriceInCents($price)
    {
        return $this->priceHelper->getPriceInCents($price);
    }
}