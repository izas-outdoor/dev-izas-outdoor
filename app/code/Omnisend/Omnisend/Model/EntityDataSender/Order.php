<?php

namespace Omnisend\Omnisend\Model\EntityDataSender;

use Omnisend\Omnisend\Model\Api\Request\RequestInterface;
use Omnisend\Omnisend\Model\RequestService;
use Magento\Sales\Api\Data\OrderInterface;

class Order
{
    /**
     * @var RequestInterface
     */
    private $orderRequest;

    /**
     * @param RequestInterface $orderRequest
     */
    public function __construct(RequestInterface $orderRequest)
    {
        $this->orderRequest = $orderRequest;
    }

    /**
     * @param OrderInterface $order
     * @param $orderId
     * @return null|string
     */
    public function send($order, $orderId)
    {
        $response = $this->orderRequest->put($orderId, $order, $order->getStoreId());

        if ($response == RequestService::HTTP_RESPONSE_NOT_FOUND) {
            $response = $this->orderRequest->post($order, $order->getStoreId());
        }

        return $response;
    }
}