<?php

namespace Omnisend\Omnisend\Helper;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\App\Area;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Element\BlockFactory;
use Magento\Store\Model\App\Emulation;

class ProductImageHelper
{
    const LIST_PRODUCT_BLOCK = 'Magento\Catalog\Block\Product\ListProduct';
    const IMAGE_TYPE = 'product_page_image_medium';

    /**
    * @var StoreManagerInterface
    */
    private $storeManager;

    /**
    * @var BlockFactory
    */
    private $blockFactory;

    /**
    * @var Emulation
    */
    private $emulation;

    /**
     * @param StoreManagerInterface $storeManager
     * @param BlockFactory $blockFactory
     * @param Emulation $emulation
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        BlockFactory $blockFactory,
        Emulation $emulation
    ) {
        $this->storeManager = $storeManager;
        $this->blockFactory = $blockFactory;
        $this->emulation = $emulation;
    }

    /**
     * @param ProductInterface $product
     * @param $storeId
     * @return string
     */
    public function getImageUrl($product, $storeId)
    {
        $this->emulation->startEnvironmentEmulation($storeId, Area::AREA_FRONTEND, true);

        $imageBlock = $this->blockFactory->createBlock(self::LIST_PRODUCT_BLOCK);
        $productImage = $imageBlock->getImage($product, self::IMAGE_TYPE);
        $imageUrl = $productImage->getImageUrl();

        $this->emulation->stopEnvironmentEmulation();

        return $imageUrl;
    }
}