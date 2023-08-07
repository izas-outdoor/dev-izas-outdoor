<?php

namespace Omnisend\Omnisend\Helper;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\CatalogInventory\Api\StockStateInterface;

class ProductStockHelper
{
    const PRODUCT_STATUS_IN_STOCK = 'inStock';
    const PRODUCT_STATUS_OUT_OF_STOCK = 'outOfStock';

    /**
     * @var StockStateInterface
     */
    private $stockState;

    /**
     * ProductStockHelper constructor.
     * @param StockStateInterface $stockState
     */
    public function __construct(StockStateInterface $stockState)
    {
        $this->stockState = $stockState;
    }

    /**
     * @param ProductInterface $product
     * @return string
     */
    public function getProductStockStatus(ProductInterface $product)
    {
        if ($this->stockState->getStockQty($product->getId()) > 0) {
            return self::PRODUCT_STATUS_IN_STOCK;
        }

        return self::PRODUCT_STATUS_OUT_OF_STOCK;
    }
}