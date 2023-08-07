<?php

namespace Omnisend\Omnisend\Model\EntityDataSender;

use Omnisend\Omnisend\Model\Api\Request\RequestInterface;
use Omnisend\Omnisend\Model\RequestService;
use Magento\Quote\Api\Data\CartInterface;

class Quote
{
    /**
     * @var RequestInterface
     */
    private $quoteRequest;

    /**
     * @param RequestInterface $quoteRequest
     */
    public function __construct(RequestInterface $quoteRequest)
    {
        $this->quoteRequest = $quoteRequest;
    }

    /**
     * @param CartInterface $quote
     * @param $quoteId
     * @return null|string
     */
    public function send($quote, $quoteId)
    {
        $response = $this->quoteRequest->put($quoteId, $quote, $quote->getStoreId());

        if ($response == RequestService::HTTP_RESPONSE_NOT_FOUND) {
            $response = $this->quoteRequest->post($quote, $quote->getStoreId());
        }

        return $response;
    }
}