<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Guest\Rma\NewReturn;

/**
 * Class Create
 * @package WebPanda\Rma\Block\Guest\Rma\NewReturn
 */
class Create extends \WebPanda\Rma\Block\Customer\Rma\Create
{
    /**
     * @return array
     */
    public function getOrders()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getOrderInfoUrl()
    {
        return $this->getUrl('rma/guest/orderInfo');
    }

    /**
     * @return string
     */
    public function getRmaCreateUrl()
    {
        return $this->getUrl('rma/guest/add');
    }

    /**
     * @return int
     */
    public function getCurrentOrder()
    {
        $orderIncrementId = $this->request->getParam('order_increment_id');
        $orderIncrementId = trim($orderIncrementId);
        $orderIncrementId = preg_replace('/^#/', '', $orderIncrementId);
        $order = $this->orderFactory->create()->loadByIncrementId($orderIncrementId);
        return $order->getId();
    }
}
