<?php

namespace Omnisend\Omnisend\Controller\Adminhtml\OrderStatus;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Omnisend\Omnisend\Api\OmnisendOrderStatusRepositoryInterface;
use Omnisend\Omnisend\Api\Data\OmnisendOrderStatusInterface;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action
{
    /**
     * @var OmnisendOrderStatusRepositoryInterface
     */
    protected $omnisendOrderStatusRepository;

    /**
     * @param Context $context
     * @param OmnisendOrderStatusRepositoryInterface $omnisendOrderStatusRepository
     */
    public function __construct(Context $context, OmnisendOrderStatusRepositoryInterface $omnisendOrderStatusRepository)
    {
        $this->omnisendOrderStatusRepository = $omnisendOrderStatusRepository;

        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$statusId = $this->getRequest()->getParam(OmnisendOrderStatusInterface::STATUS)) {
            $this->messageManager->addError(__('We can\'t find an entry to delete.'));

            return $resultRedirect->setPath('*/*/');
        }

        try {
            $this->omnisendOrderStatusRepository->deleteById($statusId);
            $this->messageManager->addSuccess(__('The order status has been deleted.'));

            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());

            return $resultRedirect->setPath('*/*/edit', [OmnisendOrderStatusInterface::STATUS => $statusId]);
        }
    }
}