<?php

namespace Omnisend\Omnisend\Model\Attribute\IsImported;

use Omnisend\Omnisend\Model\ResourceModel\ProductFactory;

class ProductAttributeUpdater
{
    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * @param ProductFactory $productFactory
     */
    public function __construct(ProductFactory $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    /**
     * @param $entityId
     * @param $isImported
     * @param $storeId
     */
    public function setIsImported($entityId, $isImported, $storeId)
    {
        $product = $this->productFactory->create();
        $product->updateIsImported($entityId, $isImported, $storeId);
    }
}