<?php

namespace Omnisend\Omnisend\Model\EntityDataSender;

use Omnisend\Omnisend\Model\Api\Request\RequestInterface;
use Omnisend\Omnisend\Model\RequestService;
use Magento\Catalog\Api\Data\ProductInterface;

class Product
{
    /**
     * @var RequestInterface
     */
    private $productRequest;

    public function __construct(RequestInterface $productRequest)
    {
        $this->productRequest = $productRequest;
    }

    /**
     * @param ProductInterface $product
     * @return null|string
     */
    public function send($product)
    {
        $response = $this->productRequest->put($product->getId(), $product, $product->getStoreId());

        if ($response == RequestService::HTTP_RESPONSE_NOT_FOUND) {
            $response = $this->productRequest->post($product, $product->getStoreId());
        }

        return $response;
    }
}