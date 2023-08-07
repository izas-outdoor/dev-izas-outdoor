<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Guest;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class View
 * @package WebPanda\Rma\Controller\Guest
 */
class View extends \WebPanda\Rma\Controller\Guest
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        try {
            $rma = $this->rmaManager->getRmaModel($this->getRequest()->getParam('id'));
            $this->coreRegistry->register('rma_request', $rma);
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
            return $this->goBack();
        }

        if (!$rma->getId()) {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Return #%1', $rma->getIncrementId()));

        return $resultPage;
    }
}
