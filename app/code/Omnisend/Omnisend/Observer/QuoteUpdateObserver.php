<?php

namespace Omnisend\Omnisend\Observer;

use Omnisend\Omnisend\Helper\CookieHelper;
use Omnisend\Omnisend\Model\Attribute\IsImported\QuoteAttributeUpdater;
use Omnisend\Omnisend\Model\Config\GeneralConfig;
use Magento\Customer\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Omnisend\Omnisend\Model\ResponseRateManagerInterface;
use Omnisend\Omnisend\Model\EntityDataSender\Quote as QuoteDataSender;
use Omnisend\Omnisend\Model\Attribute\IsImported\ImportStatus;

class QuoteUpdateObserver implements ObserverInterface
{
    const EMAIL_ID = 'email_id';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var ResponseRateManagerInterface
     */
    private $responseRateManager;

    /**
     * @var QuoteDataSender
     */
    private $quoteDataSender;

    /**
     * @var GeneralConfig
     */
    private $generalConfig;

    /**
     * @var ImportStatus
     */
    private $importStatus;

    /**
     * @var QuoteAttributeUpdater
     */
    private $quoteAttributeUpdater;

    /**
     * @var CookieHelper
     */
    private $cookieHelper;

    /**
     * @param Session $session
     * @param ResponseRateManagerInterface $responseRateManager
     * @param QuoteDataSender $quoteDataSender
     * @param GeneralConfig $generalConfig
     * @param ImportStatus $importStatus
     * @param QuoteAttributeUpdater $quoteAttributeUpdater
     * @param CookieHelper $cookieHelper
     */
    public function __construct(
        Session $session,
        ResponseRateManagerInterface $responseRateManager,
        QuoteDataSender $quoteDataSender,
        GeneralConfig $generalConfig,
        ImportStatus $importStatus,
        QuoteAttributeUpdater $quoteAttributeUpdater,
        CookieHelper $cookieHelper
    ) {
        $this->session = $session;
        $this->responseRateManager = $responseRateManager;
        $this->quoteDataSender = $quoteDataSender;
        $this->generalConfig = $generalConfig;
        $this->importStatus = $importStatus;
        $this->quoteAttributeUpdater = $quoteAttributeUpdater;
        $this->cookieHelper = $cookieHelper;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if (!$this->session->isLoggedIn()) {
            return;
        }

        $quote = $observer->getEvent()->getQuote();
        $quoteId = $quote->getId();

        if (!$this->responseRateManager->check($quote->getStoreId()) ||
            !$this->generalConfig->getIsRealTimeSynchronizationEnabled()
        ) {
            $this->quoteAttributeUpdater->setIsImported($quoteId, 0);

            return;
        }

        if ($emailId = $this->cookieHelper->getOmnisendEmailId()) {
            $quote->setData(self::EMAIL_ID, $emailId);
        }

        $response = $this->quoteDataSender->send($quote, $quoteId);
        $isImported = $this->importStatus->getImportStatus($response);
        $this->quoteAttributeUpdater->setIsImported($quoteId, $isImported);
    }
}