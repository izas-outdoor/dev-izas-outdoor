<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Adminhtml\Status;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use WebPanda\Rma\Model\StatusFactory;
use Magento\Framework\Registry;
use Magento\Framework\Controller\ResultFactory;
use WebPanda\Rma\Helper\Config as ConfigHelper;

/**
 * Class Edit
 * @package WebPanda\Rma\Controller\Adminhtml\Status
 */
class Edit extends \WebPanda\Rma\Controller\Adminhtml\Status
{
    /**
     * @var StatusFactory
     */
    protected $statusFactory;

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
     * @param StatusFactory $statusFactory
     * @param Registry $coreRegistry
     * @param ConfigHelper $configHelper
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        StatusFactory $statusFactory,
        Registry $coreRegistry,
        ConfigHelper $configHelper
    ) {
        parent::__construct($context, $resultPageFactory);
        $this->statusFactory = $statusFactory;
        $this->coreRegistry = $coreRegistry;
        $this->configHelper = $configHelper;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->statusFactory->create();

        if ($id) {
            $status = $model->load($id);
            if (!$status->getId()) {
                $this->messageManager->addErrorMessage(__('This status no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/index');
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        $this->coreRegistry->register('rma_status', $model);

        $resultPage = $this->getResultPage();
        $resultPage->setActiveMenu('WebPanda_Rma::statuses');
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Status "%1"', $model->getName()) : __('Add Status'));

        return $resultPage;
    }
}
