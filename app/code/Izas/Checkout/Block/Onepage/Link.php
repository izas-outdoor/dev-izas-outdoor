<?php
namespace Izas\Checkout\Block\Onepage;

use Magento\Framework\View\Element\Template\Context;
use Magento\Checkout\Model\Session;
use Magento\Checkout\Helper\Data as CheckoutHelper;
use Magento\Framework\Pricing\Helper\Data as CurrencyHelper;

/**
 * Class Link
 * @package Izas\Checkout\Block\Onepage
 */
class Link extends \Magento\Checkout\Block\Onepage\Link
{
    /**
     * @var CurrencyHelper
     */
    protected $currencyHelper;

    /**
     * Link constructor.
     * @param Context $context
     * @param Session $checkoutSession
     * @param CheckoutHelper $checkoutHelper
     * @param CurrencyHelper $currencyHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Session $checkoutSession,
        CheckoutHelper $checkoutHelper,
        CurrencyHelper $currencyHelper,
        array $data = []
    ) {
        $this->currencyHelper = $currencyHelper;
        parent::__construct($context, $checkoutSession, $checkoutHelper, $data);
    }

    /**
     * @return \Magento\Quote\Model\Quote
     */
    public function getQuote()
    {
        return $this->_checkoutSession->getQuote();
    }

    /**
     * @return float|string
     */
    public function getGrandTotal()
    {
        return $this->currencyHelper->currency(
            number_format($this->getQuote()->getGrandTotal(), 2),
            true,
            false
        );
    }
}