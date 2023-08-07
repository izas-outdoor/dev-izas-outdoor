<?php

namespace Omnisend\Omnisend\Model\RequestBodyBuilder;

use Omnisend\Omnisend\Helper\PriceHelper;
use Omnisend\Omnisend\Helper\ProductImageHelper;
use Omnisend\Omnisend\Helper\ProductUrlHelper;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\Data\CartItemInterface;

class CartItem extends AbstractBodyBuilder implements RequestBodyBuilderInterface
{
    const PRODUCT_TYPE_CONFIGURABLE = 'configurable';

    const CART_PRODUCT_ID = 'cartProductID';
    const PRODUCT_ID = 'productID';
    const VARIANT_ID = 'variantID';
    const SKU = 'sku';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const QUANTITY = 'quantity';
    const PRICE = 'price';
    const DISCOUNT = 'discount';
    const PRODUCT_URL = 'productUrl';
    const IMAGE_URL = 'imageUrl';

    /**
     * @var PriceHelper
     */
    private $priceHelper;

    /**
     * @var ProductUrlHelper
     */
    private $productUrlHelper;

    /**
     * @var ProductImageHelper
     */
    private $productImageHelper;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @param PriceHelper $priceHelper
     * @param ProductUrlHelper $productUrlHelper
     * @param ProductImageHelper $productImageHelper
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        PriceHelper $priceHelper,
        ProductUrlHelper $productUrlHelper,
        ProductImageHelper $productImageHelper,
        ProductRepositoryInterface $productRepository
    ) {
        $this->priceHelper = $priceHelper;
        $this->productUrlHelper = $productUrlHelper;
        $this->productImageHelper = $productImageHelper;
        $this->productRepository = $productRepository;
    }

    /**
     * @param CartItemInterface $cartItem
     * @return array
     */
    public function build($cartItem)
    {
        $productId = $cartItem->getProductId();

        $this->addData(self::CART_PRODUCT_ID, strval($cartItem->getData(Cart::CART_PRODUCT_ID)));
        $this->addData(self::PRODUCT_ID, $productId);
        $this->addData(self::SKU, $cartItem->getSku());
        $this->addData(self::TITLE, $cartItem->getName());
        $this->addData(self::DESCRIPTION, $cartItem->getDescription());
        $this->addData(self::QUANTITY, $cartItem->getQty());
        $this->addData(self::PRICE, $this->priceHelper->getPriceInCents($cartItem->getPrice()));
        $this->addData(self::DISCOUNT, $this->priceHelper->getPriceInCents($cartItem->getDiscountAmount()));
        $this->addData(self::PRODUCT_URL, $this->productUrlHelper->getProductUrl($productId, $cartItem->getStoreId()));

        if ($cartItem->getProductType() == self::PRODUCT_TYPE_CONFIGURABLE && $cartItem->getHasChildren()) {
            $productId = $cartItem->getChildren()[0]->getProductId();
        }

        $this->addData(self::VARIANT_ID, $productId);

        try {
            $product = $this->productRepository->getById($productId, false, $cartItem->getStoreId());
        } catch (NoSuchEntityException $e) {
            return $this->getData();
        }

        $this->addData(self::IMAGE_URL, $this->productImageHelper->getImageUrl($product, $cartItem->getStoreId()));

        return $this->getData();
    }
}