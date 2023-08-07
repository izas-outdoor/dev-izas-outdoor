<?php
namespace Izas\Checkout\Helper;

use Magento\Checkout\Model\Session;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Pricing\Helper\Data as CurrencyHelper;

/**
 * Class Shipping
 * @package Antikbatik\Checkout\Helper
 */
class Shipping extends AbstractHelper
{
    const XML_PATH_DEFAULT_SHIPPING_METHOD  = 'shipping/options/default_method';
    const XML_PATH_AMOUNT_FREE_SHIPPING     = 'shipping/options/amount_free_shipping';

    /**
     * @var Session
     */
    private $checkoutSession;

    /**
     * @var CurrencyHelper
     */
    private $currencyHelper;

    /**
     * Shipping constructor.
     * @param Context $context
     * @param Session $checkoutSession
     * @param CurrencyHelper $currencyHelper
     */
    public function __construct(
        Context $context,
        Session $checkoutSession,
        CurrencyHelper $currencyHelper
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->currencyHelper = $currencyHelper;
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function getDefaultShippingMethod()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEFAULT_SHIPPING_METHOD,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getAmountFreeShipping()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_AMOUNT_FREE_SHIPPING,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        if (!$this->checkoutSession->getCountryCode() && isset($_SERVER["HTTP_CF_IPCOUNTRY"])) {
            $this->checkoutSession->setCountryCode(strtoupper($_SERVER["HTTP_CF_IPCOUNTRY"]));
        }

        return $this->checkoutSession->getCountryCode();
    }

    /**
     * @return string
     */
    public function getShippingMessage()
    {
        return sprintf(
            __('Free shipping over %s purchase and 60-day return period'),
            $this->currencyHelper->currency($this->getAmountFreeShipping(), true, false)
        );
    }
}
