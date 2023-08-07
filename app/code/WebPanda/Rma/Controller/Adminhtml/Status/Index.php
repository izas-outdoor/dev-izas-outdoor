<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Adminhtml\Status;

/**
 * Class Index
 * @package WebPanda\Rma\Controller\Adminhtml\Status
 */
class Index extends \WebPanda\Rma\Controller\Adminhtml\Status
{
    /**
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultPage = $this->getResultPage();
        $resultPage->setActiveMenu('WebPanda_Rma::base');
        $resultPage->getConfig()->getTitle()->prepend(__('RMA Statuses'));

        return $resultPage;
    }
}
