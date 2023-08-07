<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Customer;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Registry;
use Magento\Customer\Model\Session;
use WebPanda\Rma\Model\RmaManager;
use WebPanda\Rma\Model\ItemFactory as RmaItemFactory;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use WebPanda\Rma\Helper\Config as ConfigHelper;
use WebPanda\Rma\Helper\Data as DataHelper;
use Magento\Framework\App\Response\Http\FileFactory;
use WebPanda\Rma\Model\PrintPackingSlip;
use Magento\Sales\Model\OrderFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Directory\Api\CountryInformationAcquirerInterface;
use Magento\Catalog\Block\Product\ImageBuilder;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\UrlInterface;

/**
 * Class OrderInfo
 * @package WebPanda\Rma\Controller\Customer
 */
class OrderInfo extends \WebPanda\Rma\Controller\Customer
{
    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var TimezoneInterface
     */
    protected $localeDate;

    /**
     * @var CountryInformationAcquirerInterface
     */
    protected $countryInformation;

    /**
     * @var ImageBuilder
     */
    protected $imageBuilder;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var DataHelper
     */
    protected $dataHelper;

    /**
     * OrderInfo constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $coreRegistry
     * @param ScopeConfigInterface $scopeConfig
     * @param Validator $formKeyValidator
     * @param Session $customerSession
     * @param RmaManager $rmaManager
     * @param RmaItemFactory $itemFactory
     * @param Filesystem $filesystem
     * @param UploaderFactory $fileUploader
     * @param ConfigHelper $configHelper
     * @param FileFactory $fileFactory
     * @param PrintPackingSlip $printPackingSlip
     * @param OrderFactory $orderFactory
     * @param TimezoneInterface $localeDate
     * @param CountryInformationAcquirerInterface $countryInformation
     * @param ImageBuilder $imageBuilder
     * @param ProductFactory $productFactory
     * @param DataHelper $dataHelper
     * @param UrlInterface $url
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        ScopeConfigInterface $scopeConfig,
        Validator $formKeyValidator,
        Session $customerSession,
        RmaManager $rmaManager,
        RmaItemFactory $itemFactory,
        Filesystem $filesystem,
        UploaderFactory $fileUploader,
        ConfigHelper $configHelper,
        FileFactory $fileFactory,
        PrintPackingSlip $printPackingSlip,
        OrderFactory $orderFactory,
        TimezoneInterface $localeDate,
        CountryInformationAcquirerInterface $countryInformation,
        ImageBuilder $imageBuilder,
        ProductFactory $productFactory,
        DataHelper $dataHelper,
        UrlInterface $url
    ) {
        parent::__construct(
            $context,
            $resultPageFactory,
            $coreRegistry,
            $scopeConfig,
            $formKeyValidator,
            $customerSession,
            $rmaManager,
            $itemFactory,
            $filesystem,
            $fileUploader,
            $configHelper,
            $fileFactory,
            $printPackingSlip,
            $url
        );
        $this->orderFactory = $orderFactory;
        $this->localeDate = $localeDate;
        $this->countryInformation = $countryInformation;
        $this->imageBuilder = $imageBuilder;
        $this->productFactory = $productFactory;
        $this->dataHelper = $dataHelper;
    }

    /**
     * View blog homepage action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $orderId = $this->getRequest()->getParam('order_id');

        $order = $this->orderFactory->create()->load($orderId);
        if (!$order->getId()) {
            $this->getResponse()->setBody(json_encode([
                'success' => false,
                'message' => __('Error loading the order'),
            ]));
            return;
        }

        $contactInfo = $this->getContactInformation($order);

        $this->getResponse()->setBody(json_encode([
            'success' => true,
            'order' => [
                'url' => $this->getOrderUrl($order->getId()),
                'increment_id' => $order->getIncrementId(),
                'customer_name' => $order->getCustomerName(),
                'customer_email' => $order->getCustomerEmail(),
                'date' => $this->formatDate($order->getCreatedAt(), 2, true)
            ],
            'contact' => $contactInfo,
            'packing_slip' => json_encode($contactInfo),
            'items' => $this->getItems($order)
        ]));
    }

    protected function getContactInformation($order)
    {
        $isVirtual = true;
        foreach ($order->getItemsCollection() as $orderItem) {
            if (!$orderItem->getIsVirtual()) {
                $isVirtual = false;
            }
        }

        $address = $isVirtual ? $order->getBillingAddress() : $order->getShippingAddress();

        return [
            'firstname' => $address->getFirstName(),
            'lastname' => $address->getLastName(),
            'company' => $address->getCompany(),
            'street' => is_array($address->getStreet()) ? implode(' ', $address->getStreet()) : $address->getStreet(),
            'city' => $address->getCity(),
            'region' => $address->getRegion(),
            'region_id' => $address->getRegionId(),
            'postcode' => $address->getPostcode(),
            'country_id' => $address->getCountryId(),
            'country_name' => $this->getCountryName($address->getCountryId()),
            'telephone' => $address->getTelephone(),
        ];
    }

    /**
     * Retrieve formatting date
     *
     * @param null|string|\DateTimeInterface $date
     * @param int $format
     * @param bool $showTime
     * @param null|string $timezone
     * @return string
     */
    public function formatDate(
        $date = null,
        $format = \IntlDateFormatter::LONG,
        $showTime = false,
        $timezone = null
    ) {
        $date = $date instanceof \DateTimeInterface ? $date : new \DateTime($date);
        return $this->localeDate->formatDateTime(
            $date,
            $format,
            $showTime ? $format : \IntlDateFormatter::NONE,
            null,
            $timezone
        );
    }

    /**
     * @param int $orderId
     * @return string
     */
    public function getOrderUrl($orderId)
    {
        return $this->_url->getUrl('sales/order/view', ['order_id' => $orderId]);
    }

    /**
     * @param $countryId
     * @return string
     */
    public function getCountryName($countryId)
    {
        return $this->countryInformation->getCountryInfo($countryId)->getFullNameLocale();
    }

    protected function getItems($order)
    {
        $openRmaItems = $this->dataHelper->getOpenItemsForOrder($order->getId());
        $openItemsQty = [];
        $returnsForItem = [];
        foreach ($openRmaItems as $item) {
            if (array_key_exists($item->getOrderItemId(), $openItemsQty)) {
                $openItemsQty[$item->getOrderItemId()] += $item->getQty();
            } else {
                $openItemsQty[$item->getOrderItemId()] = $item->getQty();
            }
            if (array_key_exists($item->getOrderItemId(), $returnsForItem)) {
                $returnsForItem[$item->getOrderItemId()][$item->getRmaId()] = [
                    'id' => $item->getRmaId(),
                    'url' => $this->_url->getUrl('rma/customer/view', ['id' => $item->getRmaId()]),
                    'increment_id' => sprintf("%'09u", $item->getRmaId())
                ];
            } else {
                $returnsForItem[$item->getOrderItemId()] = [
                    [
                        'id' => $item->getRmaId(),
                        'url' => $this->_url->getUrl('rma/customer/view', ['id' => $item->getRmaId()]),
                        'increment_id' => sprintf("%'09u", $item->getRmaId())
                    ]
                ];
            }
        }

        $finalItems = [];
        foreach ($order->getAllVisibleItems() as $orderItem) {
            if (in_array($orderItem->getProductType(), ['configurable', 'bundle'])) {
                foreach ($orderItem->getChildrenItems($orderItem) as $childItem) {
                    $availableQty = isset($openItemsQty[$childItem->getId()]) ?
                        $childItem->getQtyInvoiced() - $openItemsQty[$childItem->getId()] :
                        $childItem->getQtyInvoiced();

                    $finalItems[] = [
                        'id' => $childItem->getId(),
                        'sku' => $childItem->getSku(),
                        'name' => $childItem->getName(),
                        'image' => $this->getImage($childItem->getProduct(), 'product_small_image'),
                        'qty' => $availableQty * 1,
                        'has_returns' => !empty($returnsForItem[$childItem->getId()]),
                        'existing_returns' => !empty($returnsForItem[$childItem->getId()]) ?
                            $returnsForItem[$childItem->getId()] :
                            []
                    ];
                }
            } else {
                $availableQty = isset($openItemsQty[$orderItem->getId()]) ?
                    $orderItem->getQtyInvoiced() - $openItemsQty[$orderItem->getId()] :
                    $orderItem->getQtyInvoiced();

                $finalItems[] = [
                    'id' => $orderItem->getId(),
                    'sku' => $orderItem->getSku(),
                    'name' => $orderItem->getName(),
                    'image' => $this->getImage($orderItem->getProduct(), 'product_small_image'),
                    'qty' => $availableQty * 1,
                    'has_returns' => !empty($returnsForItem[$orderItem->getId()]),
                    'existing_returns' => !empty($returnsForItem[$orderItem->getId()]) ?
                        $returnsForItem[$orderItem->getId()] :
                        []
                ];
            }
        }

        return $finalItems;
    }

    /**
     * Retrieve product image
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param string $imageId
     * @param array $attributes
     * @return \Magento\Catalog\Block\Product\Image
     */
    public function getImage($product, $imageId, $attributes = [])
    {
        if (is_null($product)) {
            $product = $this->productFactory->create();
        }

        return $this->imageBuilder->setProduct($product)
            ->setImageId($imageId)
            ->setAttributes($attributes)
            ->create()
            ->getData();
    }
}
