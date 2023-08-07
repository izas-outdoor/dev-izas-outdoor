<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Adminhtml\Rma;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use WebPanda\Rma\Model\RmaFactory;
use Magento\Framework\Registry;
use Magento\Framework\Controller\ResultFactory;
use WebPanda\Rma\Helper\Config as ConfigHelper;

/**
 * Class Edit
 * @package WebPanda\Rma\Controller\Adminhtml\Status
 */
class Edit extends \WebPanda\Rma\Controller\Adminhtml\Rma
{
    /**
     * @var RmaFactory
     */
    protected $rmaFactory;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param RmaFactory $rmaFactory
     * @param Registry $coreRegistry
     * @param ConfigHelper $configHelper
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        RmaFactory $rmaFactory,
        Registry $coreRegistry,
        ConfigHelper $configHelper
    ) {
        parent::__construct($context, $resultPageFactory);
        $this->rmaFactory = $rmaFactory;
        $this->coreRegistry = $coreRegistry;
        $this->configHelper = $configHelper;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $rma = $this->rmaFactory->create()->load($id);
        } else {
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/index');
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $rma->addData($data);
        }

        $this->coreRegistry->register('rma_request', $rma);

        $resultPage = $this->getResultPage();
        $resultPage->setActiveMenu('WebPanda_Rma::base');
        $resultPage->getConfig()->getTitle()->prepend(__('Return #%1', $rma->getIncrementId()));

        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('WebPanda_Rma::rma_edit');
    }
}
