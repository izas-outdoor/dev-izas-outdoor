<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Adminhtml\Rma;

/**
 * Class Index
 * @package WebPanda\Rma\Controller\Adminhtml\Rma
 */
class Index extends \WebPanda\Rma\Controller\Adminhtml\Rma
{
    /**
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultPage = $this->getResultPage();
        $resultPage->setActiveMenu('WebPanda_Rma::base');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Returns'));

        return $resultPage;
    }
}
