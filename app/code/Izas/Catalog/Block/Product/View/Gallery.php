<?php
namespace Izas\Catalog\Block\Product\View;

use Magento\Catalog\Block\Product\Context;
use Magento\Framework\Stdlib\ArrayUtils;
use Magento\Framework\Json\EncoderInterface;

/**
 * Class Gallery
 * @package Izas\Catalog\Block\Product\View
 */
class Gallery extends \Magento\Catalog\Block\Product\View\Gallery
{
    /**
     * Gallery constructor.
     * @param Context $context
     * @param ArrayUtils $arrayUtils
     * @param EncoderInterface $jsonEncoder
     * @param array $data
     */
    public function __construct(
        Context $context,
        ArrayUtils $arrayUtils,
        EncoderInterface $jsonEncoder,
        array $data = []
    ) {
        parent::__construct($context, $arrayUtils, $jsonEncoder, $data);
        $this->setCacheLifetime(86400);
    }

    /**
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $cacheKeyInfo = parent::getCacheKeyInfo();
        $cacheKeyInfo[]= $this->_storeManager->getStore()->getCurrentCurrency()->getCode();
        $cacheKeyInfo[] = $this->_coreRegistry->registry('product')->getId();

        return $cacheKeyInfo;
    }
}
