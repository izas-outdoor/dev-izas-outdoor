<?php
namespace Izas\Catalog\Block\Product\View;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;

/**
 * Class Description
 * @package Izas\Catalog\Block\Product\View
 */
class Description extends \Magento\Catalog\Block\Product\View\Description
{
    /**
     * Description constructor.
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(Context $context, Registry $registry, array $data = [])
    {
        parent::__construct($context, $registry, $data);
        $this->setCacheLifetime(86400);
    }

    /**
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $key = parent::getCacheKeyInfo();
        $key[] = $this->getProduct()->getId();

        return $key;
    }
}
