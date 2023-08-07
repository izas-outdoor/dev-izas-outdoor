<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Order;

use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ProductFactory;
use WebPanda\Rma\Model\ResourceModel\Rma\CollectionFactory as RmaCollectionFactory;
use Magento\Framework\Registry;

/**
 * Class Returns
 * @package WebPanda\Rma\Block\Order
 */
class Returns extends \Magento\Framework\View\Element\Template
{
    /**
     * @var RmaCollectionFactory
     */
    protected $rmaCollectionFactory;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var array
     */
    protected $products = [];

    /**
     * Returns constructor.
     * @param Context $context
     * @param RmaCollectionFactory $rmaCollectionFactory
     * @param ProductFactory $productFactory
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        RmaCollectionFactory $rmaCollectionFactory,
        ProductFactory $productFactory,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->rmaCollectionFactory = $rmaCollectionFactory;
        $this->productFactory = $productFactory;
        $this->coreRegistry = $registry;
    }

    /**
     * Retrieve current order model instance
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        return $this->coreRegistry->registry('current_order');
    }

    /**
     * @return \WebPanda\Rma\Model\ResourceModel\Rma\Collection|bool|null
     */
    public function getRmaCollection()
    {
        $collection = $this->rmaCollectionFactory->create()
            ->addOrderFilter($this->getOrder()->getId())
            ->joinStatusAttribute(['frontend_label'])
            ->addOrder('created_at', 'DESC')
            ->setPageSize(false)
            ->addStoreFilter()
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
        return $this->getUrl('rma/customer/view', ['id' => $rmaId]);
    }
}
