<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model;

use WebPanda\Rma\Model\ResourceModel\Item\CollectionFactory as ItemCollectionFactory;
use WebPanda\Rma\Helper\Config;
use Magento\Sales\Model\OrderFactory;
use Magento\Customer\Model\CustomerFactory;
use Magento\Catalog\Model\ProductFactory;

/**
 * Class Rma
 * @package WebPanda\Rma\Model
 */
class Rma extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var \WebPanda\Rma\Model\ResourceModel\Item\Collection
     */
    protected $itemCollection;

    /**
     * @var ItemCollectionFactory
     */
    protected $itemCollectionFactory;

    /**
     * @var Config
     */
    protected $configHelper;

    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var StatusFactory
     */
    protected $statusFactory;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * Rma constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ItemCollectionFactory $itemCollectionFactory
     * @param Config $configHelper
     * @param OrderFactory $orderFactory
     * @param CustomerFactory $customerFactory
     * @param ProductFactory $productFactory
     * @param StatusFactory $statusFactory
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ItemCollectionFactory $itemCollectionFactory,
        Config $configHelper,
        OrderFactory $orderFactory,
        CustomerFactory $customerFactory,
        ProductFactory $productFactory,
        StatusFactory $statusFactory,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->configHelper = $configHelper;
        $this->orderFactory = $orderFactory;
        $this->productFactory = $productFactory;
        $this->customerFactory = $customerFactory;
        $this->statusFactory = $statusFactory;
    }

    protected function _construct()
    {
        $this->_init('WebPanda\Rma\Model\ResourceModel\Rma');
    }

    /**
     * @return string
     */
    public function getIncrementId()
    {
        return sprintf("%'09u", $this->getId());
    }

    /**
     * @param bool $forceReload
     * @return mixed
     */
    public function getItemsCollection($forceReload = false)
    {
        if (!$this->itemCollection || $forceReload) {
            $this->itemCollection = $this->itemCollectionFactory
                ->create()
                ->addRmaFilter($this->getId())
                ->joinOrderItem()
            ;
        }

        return $this->itemCollection;
    }

    /**
     * @return \Magento\Sales\Model\Order|null
     */
    public function getOrder()
    {
        if (!$this->hasData('order')) {
            $order = $this->orderFactory->create()->load($this->getOrderId());
            $this->setData('order', $order);
        }

        return $this->getData('order');
    }

    /**
     * @return \Magento\Customer\Model\Customer|null
     */
    public function getCustomer()
    {
        if (!$this->getCustomerId()) {
            return null;
        }
        if ($this->getCustomerId() && !$this->hasData('customer')) {
            $customer = $this->customerFactory->create()->load($this->getCustomerId());
            $this->setData('customer', $customer);
        }

        return $this->getData('customer');
    }

    /**
     * @return string
     */
    public function getFinalCustomerName()
    {
        if ($this->getCustomer()) {
            return $this->getCustomer()->getName();
        }

        return $this->getCustomerName();
    }

    /**
     * @return string
     */
    public function getFinalCustomerEmail()
    {
        if ($this->getCustomer()) {
            return $this->getCustomer()->getEmail();
        }

        return $this->getCustomerEmail();
    }

    /**
     * @return \WebPanda\Rma\Model\Status|null
     */
    public function getStatus()
    {
        if (!$this->getStatusId()) {
            return null;
        }
        if (!$this->hasData('status')) {
            $status = $this->statusFactory->create()->load($this->getStatusId());
            $this->setData('status', $status);
        }

        return $this->getData('status');
    }

    /**
     * @return string
     */
    public function getFinalStatusName()
    {
        if ($this->getStatus()) {
            return $this->getStatus()->getName();
        }

        return $this->getStatusName();
    }

    /**
     * @return bool
     */
    public function isVirtual()
    {
        foreach ($this->getItemsCollection() as $item) {
            if (!$item->getIsVirtual()) {
                return false;
            }
        }
        return true;
    }

    public function beforeSave()
    {
        if ($this->getStatus()) {
            $this->setStatusName($this->getStatus()->getName());
        }

        parent::beforeSave();
    }
}
