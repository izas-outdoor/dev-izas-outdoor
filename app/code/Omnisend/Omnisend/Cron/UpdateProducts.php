<?php

namespace Omnisend\Omnisend\Cron;

use Omnisend\Omnisend\Model\Attribute\IsImported\ProductAttributeUpdater;
use Omnisend\Omnisend\Model\Config\GeneralConfig;
use Omnisend\Omnisend\Model\EntityDataSender\Product as ProductDataSender;
use Omnisend\Omnisend\Setup\InstallData;
use Exception;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Omnisend\Omnisend\Model\ResponseRateManagerInterface;
use Omnisend\Omnisend\Model\Attribute\IsImported\ImportStatus;

class UpdateProducts
{
    /**
     * @var GeneralConfig
     */
    private $generalConfig;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ProductCollectionFactory
     */
    private $productCollectionFactory;

    /**
     * @var ResponseRateManagerInterface
     */
    private $responseRateManager;

    /**
     * @var ProductDataSender
     */
    private $productDataSender;

    /**
     * @var ImportStatus
     */
    private $importStatus;

    /**
     * @var ProductAttributeUpdater
     */
    private $productAttributeUpdater;

    /**
     * @param GeneralConfig $generalConfig
     * @param StoreManagerInterface $storeManager
     * @param ProductCollectionFactory $productCollectionFactory
     * @param ResponseRateManagerInterface $responseRateManager
     * @param ProductDataSender $productDataSender
     * @param ImportStatus $importStatus
     * @param ProductAttributeUpdater $productAttributeUpdater
     */
    public function __construct(
        GeneralConfig $generalConfig,
        StoreManagerInterface $storeManager,
        ProductCollectionFactory $productCollectionFactory,
        ResponseRateManagerInterface $responseRateManager,
        ProductDataSender $productDataSender,
        ImportStatus $importStatus,
        ProductAttributeUpdater $productAttributeUpdater
    ) {
        $this->generalConfig = $generalConfig;
        $this->storeManager = $storeManager;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->responseRateManager = $responseRateManager;
        $this->productDataSender = $productDataSender;
        $this->importStatus = $importStatus;
        $this->productAttributeUpdater = $productAttributeUpdater;
    }

    /**
     * @throws Exception
     */
    public function execute()
    {
        if (!$this->generalConfig->getIsCronSynchronizationEnabled()) {
            return;
        }

        $stores = $this->storeManager->getStores();

        foreach ($stores as $store) {
            $storeId = $store->getId();
            $isImported = 0;

            $collection = $this->productCollectionFactory->create();

            $collection->addAttributeToSelect('*');
            $collection->addStoreFilter($store);
            $collection->addAttributeToFilter(InstallData::IS_IMPORTED, $isImported);
            $collection->setPageSize($this->generalConfig->getMaximumEntitiesPerCron());

            $products = $collection->getItems();

            if (!$this->sendProducts($products, $storeId)) {
                return;
            }
        }
    }

    /**
     * @param ProductInterface[] $products
     * @param $storeId
     * @return bool
     * @throws Exception
     */
    public function sendProducts($products, $storeId)
    {
        foreach ($products as $product) {
            if (!$this->responseRateManager->check($storeId)) {
                return false;
            }

            $this->processProduct($product, $storeId);
        }

        return true;
    }

    /**
     * @param ProductInterface $product
     * @param $storeId
     * @throws Exception
     */
    public function processProduct(ProductInterface $product, $storeId)
    {
        $product->setData('store_id', $storeId);
        $response = $this->productDataSender->send($product);
        $isImported = $this->importStatus->getImportStatus($response);
        $this->productAttributeUpdater->setIsImported($product->getId(), $isImported, $storeId);
    }
}