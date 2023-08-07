<?php
namespace Izas\Checkout\Observer\Cart;

use Magento\Directory\Model\Country;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Event\Observer;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Event\ObserverInterface;
use Izas\Checkout\Helper\Shipping as ShippingHelper;

/**
 * Class AddShipping
 * @package Izas\Checkout\Observer\Cart
 */
class AddShipping implements ObserverInterface
{
    /**
     * @var Country
     */
    private $country;

    /**
     * @var DirectoryHelper
     */
    private $directoryHelper;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ShippingHelper
     */
    private $helper;

    /**
     * AddShipping constructor.
     * @param Country $country
     * @param DirectoryHelper $directoryHelper
     * @param StoreManagerInterface $storeManager
     * @param ShippingHelper $helper
     */
    public function __construct(
        Country $country,
        DirectoryHelper $directoryHelper,
        StoreManagerInterface $storeManager,
        ShippingHelper $helper
    ) {
        $this->country = $country;
        $this->directoryHelper = $directoryHelper;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
    }

    /**
     * @return array
     */
    private function getAllowCountries()
    {
        $allowed = array();
        $countries = $this->country->getResourceCollection()
            ->loadByStore($this->storeManager->getStore())
            ->toOptionArray(true);
        foreach ($countries as $country) {
            if ($country['value']) {
                $allowed[$country['value']] = $country;
            }
        }

        return $allowed;
    }

    /**
     * @param Observer $observer
     * @return $this
     */
    public function execute(Observer $observer)
    {
        $quote = $observer->getCart()->getQuote();
        $shippingAddress = $quote->getShippingAddress();
        $country = $this->directoryHelper->getDefaultCountry();
        if ($geopIpCountry = $this->helper->getCountryCode()) {
            $allowedCountries = $this->getAllowCountries();
            if (isset($allowedCountries[$geopIpCountry])) {
                $country = $geopIpCountry;
            }
        }

        if (!$quote->getId()) {
            $shippingAddress->setCountryId($country);
            $quote->getBillingAddress()->setCountryId($country);
        } else {
            if (!$shippingAddress->getCountryId()) {
                $shippingAddress->setCountryId($country);
                $quote->getBillingAddress()->setCountryId($country);
            }
        }

        if (!$shippingAddress->getShippingMethod()) {
            $shippingAddress->setShippingMethod($this->helper->getDefaultShippingMethod());
        }

        return $this;
    }
}