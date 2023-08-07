<?php

namespace Omnisend\Omnisend\Model\RequestBodyBuilder;

use Omnisend\Omnisend\Helper\GmtDateHelper;
use Omnisend\Omnisend\Helper\OrderStatusHelper;
use Omnisend\Omnisend\Helper\PriceHelper;
use Omnisend\Omnisend\Api\OmnisendOrderStatusRepositoryInterface;
use Omnisend\Omnisend\Observer\OrderUpdateObserver;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderPaymentInterface;
use Magento\Sales\Block\Adminhtml\Order\View\Info;

class Order extends AbstractBodyBuilder implements RequestBodyBuilderInterface
{
    const PRODUCT_TYPE_CONFIGURABLE = 'configurable';

    const ORDER_ID = 'orderID';
    const EMAIL = 'email';
    const CART_ID = 'cartID';
    const CURRENCY = 'currency';
    const ORDER_SUM = 'orderSum';
    const DISCOUNT_SUM = 'discountSum';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const PAYMENT_STATUS = 'paymentStatus';
    const PAYMENT_STATUS_DATE = 'paymentStatusDate';
    const FULFILLMENT_STATUS = 'fulfillmentStatus';
    const FULFILLMENT_STATUS_DATE = 'fulfillmentStatusDate';
    const PRODUCTS = 'products';
    const BILLING_ADDRESS = 'billingAddress';
    const SHIPPING_ADDRESS = 'shippingAddress';
    const SHIPPING_METHOD = 'shippingMethod';
    const SUB_TOTAL_SUM = 'subTotalSum';
    const TAX_SUM = 'taxSum';
    const SHIPPING_SUM = 'shippingSum';
    const PAYMENT_METHOD = 'paymentMethod';
    const CONTACT_NOTE = 'contactNote';
    const ORDER_URL = 'orderUrl';
    const EMAIL_ID = 'emailID';

    /**
     * @var PriceHelper
     */
    private $priceHelper;

    /**
     * @var OrderStatusHelper
     */
    private $orderStatusHelper;

    /**
     * @var GmtDateHelper
     */
    private $gmtDateHelper;

    /**
     * @var OmnisendOrderStatusRepositoryInterface
     */
    private $omnisendOrderStatusRepository;

    /**
     * @var OrderItemFactory
     */
    private $orderItemFactory;

    /**
     * @var AddressFactory
     */
    private $addressFactory;

    /**
     * @var Info
     */
    private $orderInfo;

    /**
     * @param PriceHelper $priceHelper
     * @param OrderStatusHelper $orderStatusHelper
     * @param GmtDateHelper $gmtDateHelper
     * @param OmnisendOrderStatusRepositoryInterface $omnisendOrderStatusRepository
     * @param OrderItemFactory $orderItemFactory
     * @param AddressFactory $addressFactory
     * @param Info $orderInfo
     */
    public function __construct(
        PriceHelper $priceHelper,
        OrderStatusHelper $orderStatusHelper,
        GmtDateHelper $gmtDateHelper,
        OmnisendOrderStatusRepositoryInterface $omnisendOrderStatusRepository,
        OrderItemFactory $orderItemFactory,
        AddressFactory $addressFactory,
        Info $orderInfo
    ) {
        $this->priceHelper = $priceHelper;
        $this->orderStatusHelper = $orderStatusHelper;
        $this->gmtDateHelper = $gmtDateHelper;
        $this->omnisendOrderStatusRepository = $omnisendOrderStatusRepository;
        $this->orderItemFactory = $orderItemFactory;
        $this->addressFactory = $addressFactory;
        $this->orderInfo = $orderInfo;
    }

    /**
     * @param OrderInterface $order
     * @return string
     */
    public function build($order)
    {
        $omnisendOrderStatus = $this->omnisendOrderStatusRepository->getById($order->getStatus());
        $paymentMethod = $this->getPaymentMethod($order->getPayment());
        $orderId = $order->getEntityId();

        $billingAddressData = null;
        $shippingAddressData = null;

        $billingAddressBuilder = $this->addressFactory->create();
        $shippingAddressBuilder = $this->addressFactory->create();

        if ($billingAddress = $order->getBillingAddress()) {
            $billingAddressData = $billingAddressBuilder->build($billingAddress);
        }

        if ($shippingAddress = $order->getShippingAddress()) {
            $shippingAddressData = $shippingAddressBuilder->build($shippingAddress);
        }

        $this->addData(self::ORDER_ID, $orderId);
        $this->addData(self::EMAIL, $order->getCustomerEmail());
        $this->addData(self::CART_ID, $order->getQuoteId());
        $this->addData(self::CURRENCY, $order->getGlobalCurrencyCode());
        $this->addData(self::ORDER_SUM, $this->priceHelper->getPriceInCents($order->getGrandTotal()));
        $this->addData(self::DISCOUNT_SUM, $this->priceHelper->getPriceInCents(abs($order->getDiscountAmount())));
        $this->addData(self::CREATED_AT, $this->gmtDateHelper->getGmtDate($order->getCreatedAt()));
        $this->addData(self::UPDATED_AT, $this->gmtDateHelper->getGmtDate($order->getUpdatedAt()));
        $this->addData(self::PAYMENT_STATUS, $omnisendOrderStatus->getPaymentStatus());
        $this->addData(self::PAYMENT_STATUS_DATE, $this->gmtDateHelper->getGmtDate($order->getUpdatedAt()));
        $this->addData(self::FULFILLMENT_STATUS, $omnisendOrderStatus->getFulfillmentStatus());
        $this->addData(self::FULFILLMENT_STATUS_DATE, $this->gmtDateHelper->getGmtDate($order->getUpdatedAt()));
        $this->addData(self::BILLING_ADDRESS, $billingAddressData);
        $this->addData(self::SHIPPING_ADDRESS, $shippingAddressData);
        $this->addData(self::SHIPPING_METHOD, $order->getShippingDescription());
        $this->addData(self::SUB_TOTAL_SUM, $this->priceHelper->getPriceInCents($order->getSubtotal()));
        $this->addData(self::TAX_SUM, $this->priceHelper->getPriceInCents($order->getTaxAmount()));
        $this->addData(self::SHIPPING_SUM, $this->priceHelper->getPriceInCents($order->getShippingAmount()));
        $this->addData(self::PAYMENT_METHOD, $paymentMethod);
        $this->addData(self::CONTACT_NOTE, $order->getCustomerNote());
        $this->addData(self::EMAIL_ID, $order->getData(OrderUpdateObserver::EMAIL_ID));

        if ($order->getCustomerId()) {
            $this->addData(self::ORDER_URL, $this->orderInfo->getViewUrl($orderId));
        }

        $orderProducts = $order->getItems();
        $omnisendProducts = array();

        foreach ($orderProducts as $orderProduct) {
            if ($orderProduct->getProductType() == self::PRODUCT_TYPE_CONFIGURABLE) {
                continue;
            }

            $orderItem = $this->orderItemFactory->create();
            $orderItem->build($orderProduct);

            array_push($omnisendProducts, $orderItem->getData());
        }

        $this->addData(self::PRODUCTS, $omnisendProducts);

        return json_encode($this->getData());
    }

    /**
     * @param OrderPaymentInterface|null $payment
     * @return null|string
     */
    protected function getPaymentMethod($payment)
    {
        if ($payment) {
            return $payment->getMethodInstance()->getTitle();
        }

        return null;
    }
}