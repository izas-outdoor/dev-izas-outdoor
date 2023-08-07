<?php
namespace Izas\Checkout\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Izas\Checkout\Helper\ShippingAddress as ShippingAddressHelper;
use Izas\Checkout\Helper\Shipping as ShippingHelper;

/**
 * Class ConfigProvider
 * @package Izas\Checkout\Model
 */
class ConfigProvider implements ConfigProviderInterface
{
    /**
     * @var ShippingAddressHelper
     */
    private $helper;

    /**
     * @var ShippingHelper
     */
    private $shippingHelper;

    /**
     * ConfigProvider constructor.
     * @param ShippingAddressHelper $helper
     * @param ShippingHelper $shippingHelper
     */
    public function __construct(ShippingAddressHelper $helper, ShippingHelper $shippingHelper)
    {
        $this->helper = $helper;
        $this->shippingHelper = $shippingHelper;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return [
            'validate_region_ids' => $this->helper->isEnabled(),
            'excluded_region_ids' => $this->helper->getRegionIds(),
            'shipping_address_validation_error_message' => $this->helper->getErrorMessage(),
            'free_shipping_message' => $this->shippingHelper->getShippingMessage()
        ];
    }
}