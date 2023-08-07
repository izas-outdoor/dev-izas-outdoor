<?php

namespace Omnisend\Omnisend\Observer;

use Omnisend\Omnisend\Model\Config\GeneralConfig;
use Omnisend\Omnisend\Model\EntityDataSender\Product as ProductDataSender;
use Omnisend\Omnisend\Model\ResponseRateManagerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Omnisend\Omnisend\Model\Attribute\IsImported\ImportStatus;

class ProductUpdateObserverBefore implements ObserverInterface
{
    /**
     * @var ResponseRateManagerInterface
     */
    private $responseRateManager;

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
     * @param ResponseRateManagerInterface $responseRateManager
     * @param ProductDataSender $productDataSender
     * @param GeneralConfig $generalConfig
     * @param ImportStatus $importStatus
     */
    public function __construct(
        ResponseRateManagerInterface $responseRateManager,
        ProductDataSender $productDataSender,
        GeneralConfig $generalConfig,
        ImportStatus $importStatus
    ) {
        $this->responseRateManager = $responseRateManager;
        $this->productDataSender = $productDataSender;
        $this->generalConfig = $generalConfig;
        $this->importStatus = $importStatus;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();

        if (!$this->responseRateManager->check($product->getStoreId()) ||
            $product->getStoreId() == 0 ||
            !$this->generalConfig->getIsRealTimeSynchronizationEnabled()
        ) {
            $product->setCustomAttribute('is_imported', 0);

            return;
        }

        $response = $this->productDataSender->send($product);
        $isImported = $this->importStatus->getImportStatus($response);
        $product->setCustomAttribute('is_imported', $isImported);
    }
}