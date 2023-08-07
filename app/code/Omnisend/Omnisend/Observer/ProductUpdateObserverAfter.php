<?php

namespace Omnisend\Omnisend\Observer;

use Omnisend\Omnisend\Model\Attribute\IsImported\ProductAttributeUpdater;
use Omnisend\Omnisend\Model\Config\GeneralConfig;
use Exception;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;
use Omnisend\Omnisend\Model\EntityDataSender\Product as ProductDataSender;
use Omnisend\Omnisend\Model\Attribute\IsImported\ImportStatus;

class ProductUpdateObserverAfter implements ObserverInterface
{
    const STORE_ID_FROM_AFTER = 'store_id_from_after';

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ProductDataSender
     */
    private $productDataSender;

    /**
     * @var GeneralConfig
     */
    private $generalConfig;

    /**
     * @var ImportStatus
     */
    private $importStatus;

    /**
     * @var ProductAttributeUpdater
     */
    private $productAttributeUpdater;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param StoreManagerInterface $storeManager
     * @param ProductDataSender $productDataSender
     * @param GeneralConfig $generalConfig
     * @param ImportStatus $importStatus
     * @param ProductAttributeUpdater $productAttributeUpdater
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        StoreManagerInterface $storeManager,
        ProductDataSender $productDataSender,
        GeneralConfig $generalConfig,
        ImportStatus $importStatus,
        ProductAttributeUpdater $productAttributeUpdater
    ) {
        $this->productRepository = $productRepository;
        $this->storeManager = $storeManager;
        $this->productDataSender = $productDataSender;
        $this->generalConfig = $generalConfig;
        $this->importStatus = $importStatus;
        $this->productAttributeUpdater = $productAttributeUpdater;
    }

    /**
     * @param Observer $observer
     * @throws Exception
     */
    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();

        if ($product->getStoreId() != 0 || !$this->generalConfig->getIsRealTimeSynchronizationEnabled()) {
            return;
        }

        $stores = $this->storeManager->getStores();

        foreach ($stores as $store) {
            $storeProduct = $this->productRepository->getById($product->getId(), false, $store->getId());
            $this->processProduct($storeProduct);
        }
    }

    /**
     * @param ProductInterface $product
     * @throws Exception
     */
    protected function processProduct(ProductInterface $product)
    {
        $response = $this->productDataSender->send($product);
        $isImported = $this->importStatus->getImportStatus($response);
        $this->productAttributeUpdater->setIsImported($product->getId(), $isImported, $product->getStoreId());
    }
}