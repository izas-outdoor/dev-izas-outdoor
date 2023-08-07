<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Customer\Rma;

use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Customer\Model\Session;
use Magento\Sales\Model\Order\Config;
use WebPanda\Rma\Helper\Data;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use WebPanda\Rma\Helper\Config as RmaConfigHelper;
use Magento\Framework\App\Request\Http;
use Magento\Sales\Model\OrderFactory;

/**
 * Class Create
 * @package WebPanda\Rma\Block\Customer\Rma
 */
class Create extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $orderCollectionFactory;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \Magento\Sales\Model\Order\Config
     */
    protected $orderConfig;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Collection
     */
    protected $orders;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var TimezoneInterface
     */
    protected $localeDate;

    /**
     * @var RmaConfigHelper
     */
    protected $configHelper;

    /**
     * @var Http
     */
    protected $request;

    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * Create constructor.
     * @param Context $context
     * @param CollectionFactory $orderCollectionFactory
     * @param Session $customerSession
     * @param Config $orderConfig
     * @param Data $helper
     * @param TimezoneInterface $localeDate
     * @param RmaConfigHelper $configHelper
     * @param Http $request
     * @param OrderFactory $orderFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $orderCollectionFactory,
        Session $customerSession,
        Config $orderConfig,
        Data $helper,
        TimezoneInterface $localeDate,
        RmaConfigHelper $configHelper,
        Http $request,
        OrderFactory $orderFactory,
        array $data = []
    ) {
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->customerSession = $customerSession;
        $this->orderConfig = $orderConfig;
        $this->helper = $helper;
        $this->localeDate = $localeDate;
        $this->configHelper = $configHelper;
        $this->request = $request;
        $this->orderFactory = $orderFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return bool|\Magento\Sales\Model\ResourceModel\Order\Collection
     */
    public function getOrders()
    {
        if (!($customerId = $this->customerSession->getCustomerId())) {
            return false;
        }
        if (!$this->orders) {
            $this->orders = $this->orderCollectionFactory->create($customerId)
                ->addFieldToSelect('*')
                ->addFieldToFilter(
                    'status',
                    ['in' => $this->orderConfig->getVisibleOnFrontStatuses()]
                )->setOrder(
                    'created_at',
                    'desc'
                );
        }

        return $this->orders;
    }

    public function getJsonConfig()
    {
        $data = [
            'orders' => []
        ];

        foreach ($this->getOrders() as $order) {
            if ($this->helper->isAllowedForOrder($order)) {
                $data['orders'][$order->getId()] = [
                    'id' => $order->getId(),
                    'increment_id' => $order->getIncrementId(),
                    'date' => $this->formatDate($this->localeDate->date(new \DateTime($order->getCreatedAt())), 2, false)
                ];
            }
        }

        return json_encode($data);
    }

    /**
     * @return string
     */
    public function getRmaCreateUrl()
    {
        return $this->getUrl('rma/customer/add');
    }

    /**
     * @return string
     */
    public function getOrderInfoUrl()
    {
        return $this->getUrl('rma/customer/orderInfo');
    }

    /**
     * @return string
     */
    public function getResolutionLabel()
    {
        return $this->configHelper->getResolutionFrontendLabel();
    }

    /**
     * @return array
     */
    public function getResolutionOptions()
    {
        return $this->configHelper->getResolutionOptions();
    }

    /**
     * @return string
     */
    public function getItemConditionLabel()
    {
        return $this->configHelper->getItemConditionFrontendLabel();
    }

    /**
     * @return array
     */
    public function getItemConditionOptions()
    {
        return $this->configHelper->getItemConditionOptions();
    }

    /**
     * @return string
     */
    public function getReasonLabel()
    {
        return $this->configHelper->getReasonFrontendLabel();
    }

    /**
     * @return array
     */
    public function getReasonOptions()
    {
        return $this->configHelper->getReasonOptions();
    }

    /**
     * @return string
     */
    public function getSpecialStyle()
    {
        return $this->configHelper->getSpecialStyle();
    }

    public function getCurrentOrder()
    {
        return $this->request->getParam('order_id');
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
}
