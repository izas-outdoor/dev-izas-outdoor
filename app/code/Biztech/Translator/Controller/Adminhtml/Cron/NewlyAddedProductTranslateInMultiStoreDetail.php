<?php

namespace Biztech\Translator\Controller\Adminhtml\Cron;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class NewlyAddedProductTranslateInMultiStoreDetail extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Backend\Model\View\Result\Page
     */
    protected $resultPage;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $this->resultPage = $this->resultPageFactory->create();
        $this->resultPage ->getConfig()->getTitle()->set((__('Newly Added Product Translation Detail')));
        return $this->resultPage;
    }
     /**
     * Check admin permissions for this controller
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Biztech_Translator::biztech_newlyaddedproducttranslateinallstore');
    }
}
