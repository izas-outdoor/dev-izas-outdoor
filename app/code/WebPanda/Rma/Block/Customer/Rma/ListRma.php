<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Customer\Rma;

use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Catalog\Model\ProductFactory;
use WebPanda\Rma\Model\ResourceModel\Rma\CollectionFactory as RmaCollectionFactory;

/**
 * Class ListRma
 * @package WebPanda\Rma\Block\Customer\Request
 */
class ListRma extends \Magento\Framework\View\Element\Template
{
    /**
     * @var RmaCollectionFactory
     */
    protected $rmaCollectionFactory;

    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var array
     */
    protected $products = [];

    /**
     * ListRma constructor.
     * @param Context $context
     * @param RmaCollectionFactory $rmaCollectionFactory
     * @param CustomerSession $customerSession
     * @param ProductFactory $productFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        RmaCollectionFactory $rmaCollectionFactory,
        CustomerSession $customerSession,
        ProductFactory $productFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->rmaCollectionFactory = $rmaCollectionFactory;
        $this->customerSession = $customerSession;
        $this->productFactory = $productFactory;
    }

    /**
     * @return \WebPanda\Rma\Model\ResourceModel\Rma\Collection|bool|null
     */
    public function getRmaCollection()
    {
        if (!($customerId = $this->customerSession->getCustomerId())) {
            return false;
        }
        $collection = $this->rmaCollectionFactory->create()
            ->addCustomerFilter($customerId)
            ->joinStatusAttribute(['frontend_label'])
            ->joinOrders()
            ->addOrder('created_at', 'DESC')
            ->setPageSize(false)
        ;

        return $collection;
    }

    /**
     * @param int $productId
     * @return \Magento\Catalog\Model\Product
     */
    protected function getProduct($productId)
    {
        if (!isset($this->products[$productId])) {
            $this->products[$productId] = $this->productFactory->create()->load($productId);
        }
        return $this->products[$productId];
    }

    /**
     * @param $productId
     * @return bool
     */
    public function getProductExists($productId)
    {
        if (
            $this->getProduct($productId)->getId() &&
            $this->getProduct($productId)->getStatus() == \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param int $orderId
     * @return string
     */
    public function getOrderUrl($orderId)
    {
        return $this->getUrl('sales/order/view', ['order_id' => $orderId]);
    }

    /**
     * @param $rmaItem
     * @return string
     */
    public function getProductUrl($rmaItem)
    {
        $product = $this->getProduct($rmaItem->getProductId());
        $parentProductId = $rmaItem->getParentProductId();
        if ($parentProductId) {
            $parentProduct = $this->getProduct($parentProductId);
            return $parentProduct->getProductUrl();
        }

        return $product->getProductUrl();
    }

    /**
     * @param $rmaId
     * @return string
     */
    public function getRequestUrl($rmaId)
    {
        return $this->getUrl('*/*/view', ['id' => $rmaId]);
    }
}
