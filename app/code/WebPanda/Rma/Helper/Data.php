<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Helper;

use Magento\Backend\Model\Url;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Helper\Context;
use WebPanda\Rma\Model\StatusFactory;
use WebPanda\Rma\Model\ResourceModel\Item\CollectionFactory as RmaItemCollectionFactory;
use WebPanda\Rma\Model\Source\Rma\Status as StatusSource;
use WebPanda\Rma\Model\ResourceModel\Rma as RmaResourceModel;

/**
 * Class Data
 * @package WebPanda\Rma\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Url
     */
    protected $url;

    /**
     * @var StatusFactory
     */
    protected $statusFactory;

    /**
     * @var Config
     */
    protected $configHelper;

    /**
     * @var RmaItemCollectionFactory
     */
    protected $itemCollectionFactory;

    /**
     * @var RmaResourceModel
     */

    protected $rmaResourceModel;

    /**
     * Data constructor.
     * @param Context $context
     * @param Url $url
     * @param StatusFactory $statusFactory
     * @param Config $configHelper
     * @param RmaItemCollectionFactory $itemCollectionFactory
     */
    public function __construct(
        Context $context,
        Url $url,
        StatusFactory $statusFactory,
        Config $configHelper,
        RmaItemCollectionFactory $itemCollectionFactory,
        RmaResourceModel $rmaResourceModel
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->url = $url;
        $this->statusFactory = $statusFactory;
        $this->configHelper = $configHelper;
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->rmaResourceModel = $rmaResourceModel;
        parent::__construct($context);
    }

    /**
     * @param $rma
     * @return string
     */
    public function getRmaUrl($rma)
    {
        $this->urlBuilder->setScope($rma->getStoreId());
        if ($rma->getCustomer()) {
            $rmaLink = $this->urlBuilder->getUrl(
                'rma/customer/view',
                ['id' => $rma->getId(), '_nosid' => true]
            );
        } else {
            $rmaLink = $this->urlBuilder->getUrl(
                'rma/guest/view',
                ['id' => $rma->getId(), '_nosid' => true]
            );
        }

        return $rmaLink;
    }

    /**
     * @param $rma
     * @return string
     */
    public function getAdminRmaUrl($rma)
    {
        return $this->url->getUrl('rma_admin/rma/edit', ['id' => $rma->getId()]);
    }

    /**
     * @param $order
     * @return string
     */
    public function getOrderUrl($order){
        $this->urlBuilder->setScope($order->getStoreId());
        return $this->urlBuilder->getUrl('sales/order/view', ['order_id' => $order->getParentOrderId()]);
    }

    /**
     * @param $order
     * @return string
     */
    public function getAdminOrderUrl($order)
    {
        return $this->url->getUrl('sales/order/view', ['order_id' => $order->getId()]);
    }

    /**
     * @param $rma
     * @return string
     */
    public function getStatusHtml($rma)
    {
        $statusLabel = $rma->getStatusFrontendLabel() ?
            $rma->getStatusFrontendLabel() :
            $rma->getStatusName();

        if ($rma->getStatus()) {
            return '<span class="rma-status-color" style="background-color: ' . $rma->getStatus()->getColor() . '">' . $statusLabel . '</span>';
        }

        return '<span class="rma-status-color" style="background-color: red;">' . $statusLabel . '</span>';
    }

    /**
     * Check whether the given order is allowed for RMA
     *
     * @param \Magento\Sales\Model\Order $order
     * @return bool
     */
    public function isAllowedForOrder($order)
    {
        if ($this->configHelper->canCreateRmaForOrder($order->getStatus())) {
            $returnPeriod = $this->configHelper->getReturnPeriod();
            if (!$returnPeriod) {
                return true;
            }

            $lastInvoiceTime = 0;
            foreach ($order->getInvoiceCollection() as $invoice) {
                $invoiceTime = strtotime($invoice->getCreatedAt());
                if ($invoiceTime > $lastInvoiceTime) {
                    $lastInvoiceTime = $invoiceTime;
                }
            }
            if ($lastInvoiceTime && $lastInvoiceTime >= strtotime(sprintf("-%d day", $returnPeriod), time())) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $order
     * @return string
     */
    public function getOrderAddReturnLink($order)
    {
        if (
            is_object($order) &&
            $this->isAllowedForOrder($order) &&
            $this->isReturnOrderQtyAvailable($order)
        ) {
            $rmaCreateLink = $this->urlBuilder->getUrl(
                'rma/customer/create',
                ['order_id' => $order->getId(), '_nosid' => true]
            );
            return '<a href="' . $rmaCreateLink . '">' . __('Request Return') . '</a>';
        }

        return '';
    }

    public function isReturnOrderQtyAvailable($order)
    {
        $openItemsQty = $this->getOpenItemsQty($order->getId());
        foreach ($order->getItemsCollection() as $orderItem) {
            $availableQty = (float)isset($openItemsQty[$orderItem->getId()]) ?
                $orderItem->getQtyInvoiced() - $openItemsQty[$orderItem->getId()] :
                $orderItem->getQtyInvoiced();

            if ($availableQty > 0) {
                return true;
            }
        }
    }

    /**
     * @param $orderId
     * @return array
     */
    public function getOpenItemsQty($orderId)
    {
        $openRmaItems = $this->getOpenItemsForOrder($orderId);
        $openItemsQty = [];
        foreach ($openRmaItems as $item) {
            if (array_key_exists($item->getOrderItemId(), $openItemsQty)) {
                $openItemsQty[$item->getOrderItemId()] += $item->getQty();
            } else {
                $openItemsQty[$item->getOrderItemId()] = $item->getQty();
            }
        }

        return $openItemsQty;
    }

    /**
     * Get all order items that have pending rma request or are complete but of type refund
     *
     * @param $orderId
     * @return array
     */
    public function getOpenItemsForOrder($orderId)
    {
        // get all the items that are not completed or canceled
        $collection1 = $this->itemCollectionFactory->create()
            ->joinRma()
            ->addFieldToFilter('rma.order_id', $orderId)
            ->addFieldToFilter('rma.status_id', ['nin' => [StatusSource::CANCELED, StatusSource::COMPLETE]]);

        // get all the items that are completed or canceled and are of type Refund
        $collection2 = $this->itemCollectionFactory->create()
            ->joinRma()
            ->addFieldToFilter('rma.order_id', $orderId)
            ->addFieldToFilter('rma.status_id', ['in' => [StatusSource::COMPLETE]])
            ->addFieldToFilter('resolution_id', 2);

        return array_merge($collection1->getItems(), $collection2->getItems());
    }

    public function getRmasUrlByOrder($order) {
        $rmaLinks = [];
        $this->urlBuilder->setScope($order->getStoreId());
        $orderId = $order->getEntityId();
        $rmas = $this->rmaResourceModel->getRmasId($orderId);
        // return $rmasId;
        foreach ($rmas as $key => $value) {

            $rmaLinks[$value['id']] = $this->urlBuilder->getUrl(
                'rma/customer/view',
                ['id' => $value['id'], '_nosid' => true]
            );
        }

        return $rmaLinks;
        
    }
}
