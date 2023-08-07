<?php
namespace Izas\Checkout\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class ShippingAddress
 * @package Izas\Checkout\Helper
 */
class ShippingAddress extends AbstractHelper
{
    const XML_PATH_SHIPPING_ADDRESS_VALIDATION_ENABLED      = 'checkout/shipping_address/enabled';
    const XML_PATH_SHIPPING_ADDRESS_VALIDATION_REGION_IDS   = 'checkout/shipping_address/region_ids';
    const XML_PATH_SHIPPING_ADDRESS_VALIDATION_MESSAGE      = 'checkout/shipping_address/message';

    /**
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SHIPPING_ADDRESS_VALIDATION_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return array
     */
    public function getRegionIds()
    {
        if (!$this->isEnabled()) {
            return [];
        }

        $regions = trim($this->scopeConfig->getValue(
            self::XML_PATH_SHIPPING_ADDRESS_VALIDATION_REGION_IDS,
            ScopeInterface::SCOPE_STORE
        ));

        return $regions ? array_map('intval', explode(',', $regions)) : [];
    }

    /**
     * @return mixed|string
     */
    public function getErrorMessage()
    {
        if (!$this->isEnabled()) {
            return '';
        }

        return $this->scopeConfig->getValue(
            self::XML_PATH_SHIPPING_ADDRESS_VALIDATION_MESSAGE,
            ScopeInterface::SCOPE_STORE
        );
    }
}