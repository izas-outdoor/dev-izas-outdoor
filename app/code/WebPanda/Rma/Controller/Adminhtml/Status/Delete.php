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
use WebPanda\Rma\Model\Source\Rma\Status as SourceStatus;

/**
 * Class Delete
 * @package WebPanda\Rma\Controller\Adminhtml\Status
 */
class Delete extends \WebPanda\Rma\Controller\Adminhtml\Status
{
    /**
     * @var StatusFactory
     */
    protected $statusFactory;

    /**
     * Delete constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param StatusFactory $statusFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        StatusFactory $statusFactory
    ) {
        parent::__construct($context, $resultPageFactory);
        $this->statusFactory = $statusFactory;
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->statusFactory->create();
                $model->load($id);
                if (in_array($model->getId(), SourceStatus::getCoreStatuses())) {
                    throw new \Exception(__('You are not allowed to delete this status.'));
                }
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the status.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a status to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
