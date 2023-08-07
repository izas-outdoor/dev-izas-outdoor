<?php

namespace Omnisend\Omnisend\Observer;

use Omnisend\Omnisend\Helper\CookieHelper;
use Omnisend\Omnisend\Model\Attribute\IsImported\OrderAttributeUpdater;
use Omnisend\Omnisend\Model\Config\GeneralConfig;
use Omnisend\Omnisend\Model\ResponseRateManagerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Omnisend\Omnisend\Model\EntityDataSender\Order as OrderDataSender;
use Omnisend\Omnisend\Model\Attribute\IsImported\ImportStatus;

class OrderUpdateObserver implements ObserverInterface
{
    const EMAIL_ID = 'email_id';

    /**
     * @var ResponseRateManagerInterface
     */
    private $responseRateManager;

    /**
     * @var OrderDataSender
     */
    private $orderDataSender;

    /**
     * @var GeneralConfig
     */
    private $generalConfig;

    /**
     * @var ImportStatus
     */
    private $importStatus;

    /**
     * @var OrderAttributeUpdater
     */
    private $orderAttributeUpdater;

    /**
     * @var CookieHelper
     */
    private $cookieHelper;

    /**
     * @param ResponseRateManagerInterface $responseRateManager
     * @param OrderDataSender $orderDataSender
     * @param GeneralConfig $generalConfig
     * @param ImportStatus $importStatus
     * @param OrderAttributeUpdater $orderAttributeUpdater
     * @param CookieHelper $cookieHelper
     */
    public function __construct(
        ResponseRateManagerInterface $responseRateManager,
        OrderDataSender $orderDataSender,
        GeneralConfig $generalConfig,
        ImportStatus $importStatus,
        OrderAttributeUpdater $orderAttributeUpdater,
        CookieHelper $cookieHelper
    ) {
        $this->responseRateManager = $responseRateManager;
        $this->orderDataSender = $orderDataSender;
        $this->generalConfig = $generalConfig;
        $this->importStatus = $importStatus;
        $this->orderAttributeUpdater = $orderAttributeUpdater;
        $this->cookieHelper = $cookieHelper;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $orderId = $order->getEntityId();

        if (!$this->responseRateManager->check($order->getStoreId()) ||
            !$this->generalConfig->getIsRealTimeSynchronizationEnabled()
        ) {
            $this->orderAttributeUpdater->setIsImported($orderId, 0);

            return;
        }

        if ($emailId = $this->cookieHelper->getOmnisendEmailId()) {
            $order->setData(self::EMAIL_ID, $emailId);
        }

        $response = $this->orderDataSender->send($order, $orderId);
        $isImported = $this->importStatus->getImportStatus($response);
        $this->orderAttributeUpdater->setIsImported($orderId, $isImported);
    }
}