<?php

namespace Omnisend\Omnisend\Observer;

use Magento\Framework\App\RequestInterface;
use Omnisend\Omnisend\Model\Attribute\IsImported\CustomerAttributeUpdater;
use Omnisend\Omnisend\Model\Config\GeneralConfig;
use Omnisend\Omnisend\Model\CustomerEmailChangeHandlerInterface;
use Omnisend\Omnisend\Model\ResponseRateManagerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Omnisend\Omnisend\Model\EntityDataSender\Customer as CustomerDataSender;
use Omnisend\Omnisend\Model\Attribute\IsImported\ImportStatus;

class CustomerUpdateObserver implements ObserverInterface
{
    const ARRAY_INDEX_CHANGE_EMAIL = 'change_email';

    /**
     * @var ResponseRateManagerInterface
     */
    private $responseRateManager;

    /**
     * @var CustomerDataSender
     */
    private $customerDataSender;

    /**
     * @var GeneralConfig
     */
    private $generalConfig;

    /**
     * @var ImportStatus
     */
    private $importStatus;

    /**
     * @var CustomerAttributeUpdater
     */
    private $customerAttributeUpdater;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var CustomerEmailChangeHandlerInterface
     */
    private $customerEmailChangeHandler;

    /**
     * @param ResponseRateManagerInterface $responseRateManager
     * @param CustomerDataSender $customerDataSender
     * @param GeneralConfig $generalConfig
     * @param ImportStatus $importStatus
     * @param CustomerAttributeUpdater $customerAttributeUpdater
     * @param RequestInterface $request
     * @param CustomerEmailChangeHandlerInterface $customerEmailChangeHandler
     */
    public function __construct(
        ResponseRateManagerInterface $responseRateManager,
        CustomerDataSender $customerDataSender,
        GeneralConfig $generalConfig,
        ImportStatus $importStatus,
        CustomerAttributeUpdater $customerAttributeUpdater,
        RequestInterface $request,
        CustomerEmailChangeHandlerInterface $customerEmailChangeHandler
    ) {
        $this->responseRateManager = $responseRateManager;
        $this->customerDataSender = $customerDataSender;
        $this->generalConfig = $generalConfig;
        $this->importStatus = $importStatus;
        $this->customerAttributeUpdater = $customerAttributeUpdater;
        $this->request = $request;
        $this->customerEmailChangeHandler = $customerEmailChangeHandler;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $customerId = $customer->getId();

        if (!$this->responseRateManager->check($customer->getStoreId()) ||
            !$this->generalConfig->getIsRealTimeSynchronizationEnabled()
        ) {
           
            $this->customerAttributeUpdater->setIsImported($customerId, 0);
            $this->processEmailChangedFlag($customerId);
       
            return;
        }
     
        if ($this->checkForEmailChange()) {
            $response = $this->customerEmailChangeHandler->handleEmailChange($customer);
        } else {
            $response = $this->customerDataSender->send($customer);
        }
    
        $isImported = $this->importStatus->getImportStatus($response);
        $this->customerAttributeUpdater->setIsImported($customerId, $isImported);
    }

    /**
     * @param int $customerId
     */
    protected function processEmailChangedFlag($customerId)
    {
        if (!$this->checkForEmailChange()) {
            return;
        }

        $this->customerAttributeUpdater->setEmailChangedFlag($customerId, 1);
    }

    /**
     * @return bool
     */
    protected function checkForEmailChange()
    {
        $postValue = $this->request->getPostValue();

        if (is_array($postValue) && isset($postValue[self::ARRAY_INDEX_CHANGE_EMAIL])) {
            return true;
        }

        return false;
    }
}