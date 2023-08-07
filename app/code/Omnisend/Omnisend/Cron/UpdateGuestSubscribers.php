<?php

namespace Omnisend\Omnisend\Cron;

use Omnisend\Omnisend\Helper\SubscriberFilter;
use Omnisend\Omnisend\Model\Attribute\IsImported\AttributeUpdaterInterface;
use Omnisend\Omnisend\Model\Config\GeneralConfig;
use Omnisend\Omnisend\Model\EntityDataSender\Subscriber as SubscriberDataSender;
use Magento\Newsletter\Model\Subscriber;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Newsletter\Model\ResourceModel\Subscriber\CollectionFactory as SubscriberCollectionFactory;
use Omnisend\Omnisend\Model\ResponseRateManagerInterface;
use Omnisend\Omnisend\Model\Attribute\IsImported\ImportStatus;

class UpdateGuestSubscribers
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
     * @var SubscriberCollectionFactory
     */
    private $subscriberCollectionFactory;

    /**
     * @var ResponseRateManagerInterface
     */
    private $responseRateManager;

    /**
     * @var SubscriberDataSender
     */
    private $subscriberDataSender;

    /**
     * @var ImportStatus
     */
    private $importStatus;

    /**
     * @var SubscriberFilter
     */
    private $subscriberFilter;

    /**
     * @var AttributeUpdaterInterface
     */
    private $subscriberAttributeUpdater;

    /**
     * @param GeneralConfig $generalConfig
     * @param StoreManagerInterface $storeManager
     * @param SubscriberCollectionFactory $subscriberCollectionFactory
     * @param ResponseRateManagerInterface $responseRateManager
     * @param SubscriberDataSender $productDataSender
     * @param ImportStatus $importStatus
     * @param SubscriberFilter $subscriberFilter
     * @param AttributeUpdaterInterface $subscriberAttributeUpdater
     */
    public function __construct(
        GeneralConfig $generalConfig,
        StoreManagerInterface $storeManager,
        SubscriberCollectionFactory $subscriberCollectionFactory,
        ResponseRateManagerInterface $responseRateManager,
        SubscriberDataSender $productDataSender,
        ImportStatus $importStatus,
        SubscriberFilter $subscriberFilter,
        AttributeUpdaterInterface $subscriberAttributeUpdater
    ) {
        $this->generalConfig = $generalConfig;
        $this->storeManager = $storeManager;
        $this->subscriberCollectionFactory = $subscriberCollectionFactory;
        $this->responseRateManager = $responseRateManager;
        $this->subscriberDataSender = $productDataSender;
        $this->importStatus = $importStatus;
        $this->subscriberFilter = $subscriberFilter;
        $this->subscriberAttributeUpdater = $subscriberAttributeUpdater;
    }

    public function execute()
    {
        if (!$this->generalConfig->getIsCronSynchronizationEnabled()) {
            return;
        }

        $stores = $this->storeManager->getStores();

        foreach ($stores as $store) {
            $storeId = $store->getId();

            $collection = $this->subscriberFilter->setCollectionFilters(
                $this->subscriberCollectionFactory->create(),
                $storeId
            );

            $subscribers = $collection->getItems();

            if (!$this->sendSubscribers($subscribers, $storeId)) {
                return;
            }
        }
    }

    /**
     * @param Subscriber[] $subscribers
     * @param $storeId
     * @return bool
     */
    public function sendSubscribers($subscribers, $storeId)
    {
        foreach ($subscribers as $subscriber) {
            if (!$this->responseRateManager->check($storeId)) {
                return false;
            }

            $this->processSubscriber($subscriber);
        }

        return true;
    }

    /**
     * @param Subscriber $subscriber
     */
    public function processSubscriber(Subscriber $subscriber)
    {
        $response = $this->subscriberDataSender->send($subscriber);
        $isImported = $this->importStatus->getImportStatus($response);

        if ($isImported) {
            $this->subscriberAttributeUpdater->setIsImported($subscriber->getId(), $isImported);
        }
    }
}