<?php
namespace Izas\Checkout\Model;

use Magento\Framework\Exception\StateException;
use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Quote\Api\PaymentMethodManagementInterface;
use Magento\Checkout\Model\PaymentDetailsFactory;
use Magento\Quote\Api\CartTotalRepositoryInterface;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\QuoteAddressValidator;
use Psr\Log\LoggerInterface as Logger;
use Magento\Customer\Api\AddressRepositoryInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\TotalsCollector;
use Magento\Checkout\Api\ShippingInformationManagementInterface;
use Magento\Quote\Api\Data\CartExtensionFactory;
use Magento\Quote\Model\ShippingAssignmentFactory;
use Magento\Quote\Model\ShippingFactory;
use Izas\Checkout\Helper\ShippingAddress as ShippingAddressHelper;

/**
 * Class ShippingInformationManagement
 * @package Izas\Checkout\Model
 */
class ShippingInformationManagement extends \Magento\Checkout\Model\ShippingInformationManagement implements
    ShippingInformationManagementInterface
{
    /**
     * @var ShippingAddressHelper
     */
    protected $shippingAddressHelper;

    /**
     * ShippingInformationManagement constructor.
     * @param PaymentMethodManagementInterface $paymentMethodManagement
     * @param PaymentDetailsFactory $paymentDetailsFactory
     * @param CartTotalRepositoryInterface $cartTotalsRepository
     * @param CartRepositoryInterface $quoteRepository
     * @param QuoteAddressValidator $addressValidator
     * @param Logger $logger
     * @param AddressRepositoryInterface $addressRepository
     * @param ScopeConfigInterface $scopeConfig
     * @param TotalsCollector $totalsCollector
     * @param ShippingAddressHelper $shippingAddressHelper
     * @param CartExtensionFactory|null $cartExtensionFactory
     * @param ShippingAssignmentFactory|null $shippingAssignmentFactory
     * @param ShippingFactory|null $shippingFactory
     */
    public function __construct(
        PaymentMethodManagementInterface $paymentMethodManagement,
        PaymentDetailsFactory $paymentDetailsFactory,
        CartTotalRepositoryInterface $cartTotalsRepository,
        CartRepositoryInterface $quoteRepository,
        QuoteAddressValidator $addressValidator,
        Logger $logger,
        AddressRepositoryInterface $addressRepository,
        ScopeConfigInterface $scopeConfig,
        TotalsCollector $totalsCollector,
        ShippingAddressHelper $shippingAddressHelper,
        CartExtensionFactory $cartExtensionFactory = null,
        ShippingAssignmentFactory $shippingAssignmentFactory = null,
        ShippingFactory $shippingFactory = null
    ) {
        $this->shippingAddressHelper = $shippingAddressHelper;
        parent::__construct(
            $paymentMethodManagement,
            $paymentDetailsFactory,
            $cartTotalsRepository,
            $quoteRepository,
            $addressValidator,
            $logger,
            $addressRepository,
            $scopeConfig,
            $totalsCollector,
            $cartExtensionFactory,
            $shippingAssignmentFactory,
            $shippingFactory
        );
    }

    /**
     * @param $address
     * @return bool
     */
    protected function validateRegion($address)
    {
        $valid = true;
        if ($regionId = $address->getRegionId()) {
            $valid = !in_array($regionId, $this->shippingAddressHelper->getRegionIds());
        }

        return $valid;
    }

    /**
     * @inheritdoc
     */
    public function saveAddressInformation($cartId, ShippingInformationInterface $addressInformation)
    {
        if ($this->shippingAddressHelper->isEnabled()) {
            $address = $addressInformation->getShippingAddress();
            if (!$this->validateRegion($address)) {
                throw new StateException(__($this->shippingAddressHelper->getErrorMessage()));
            }
        }

        return parent::saveAddressInformation($cartId, $addressInformation);
    }
}
