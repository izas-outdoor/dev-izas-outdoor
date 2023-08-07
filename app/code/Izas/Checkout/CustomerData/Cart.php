<?php
namespace Izas\Checkout\CustomerData;

use Magento\Catalog\Model\ResourceModel\Url;
use Magento\Checkout\CustomerData\ItemPoolInterface;
use Izas\Checkout\Helper\Shipping;
use Magento\Checkout\Helper\Data;
use Magento\Checkout\Model\Cart as ModelCart;
use Magento\Checkout\Model\Session;
use Magento\Framework\View\LayoutInterface;

/**
 * Class Cart
 * @package Izas\Checkout\CustomerData
 */
class Cart extends \Magento\Checkout\CustomerData\Cart
{

    /**
     * @var Shipping
     */
    protected $helperShipping;

    /**
     * Cart constructor.
     * @param Session $checkoutSession
     * @param Url $catalogUrl
     * @param ModelCart $checkoutCart
     * @param Data $checkoutHelper
     * @param ItemPoolInterface $itemPoolInterface
     * @param LayoutInterface $layout
     * @param Shipping $helperShipping
     * @param array $data
     */
    public function __construct(
        Session $checkoutSession,
        Url $catalogUrl,
        ModelCart $checkoutCart,
        Data $checkoutHelper,
        ItemPoolInterface $itemPoolInterface,
        LayoutInterface $layout,
        Shipping $helperShipping,
        array $data = []
    ) {
        $this->helperShipping = $helperShipping;
        parent::__construct(
            $checkoutSession,
            $catalogUrl,
            $checkoutCart,
            $checkoutHelper,
            $itemPoolInterface,
            $layout,
            $data
        );
    }


    /**
     * @return array
     */
    public function getSectionData()
    {
        $data = parent::getSectionData();
        $add =  ['minicart_bottom' => $this->helperShipping->getShippingMessage()];
        return array_merge($data, $add);
    }
}
