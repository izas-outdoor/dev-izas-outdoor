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
use Magento\Framework\Controller\ResultFactory;
use WebPanda\Rma\Model\RmaManager;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 * @package WebPanda\Rma\Controller\Adminhtml\Rma
 */
class Save extends \WebPanda\Rma\Controller\Adminhtml\Rma
{
    /**
     * @var RmaFactory
     */
    protected $rmaFactory;

    /**
     * @var RmaManager
     */
    protected $rmaManager;

    /**
     * Save constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param RmaFactory $rmaFactory
     * @param RmaManager $rmaManager
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        RmaFactory $rmaFactory,
        RmaManager $rmaManager
    ) {
        parent::__construct($context, $resultPageFactory);
        $this->rmaFactory = $rmaFactory;
        $this->rmaManager = $rmaManager;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        $rmaId = $this->getRequest()->getParam('id');
        $back = $this->getRequest()->getParam('back');

        if (!$rmaId) {
            $this->messageManager->addError(__('You are not allowed to create RMA Returns from admin area.'));
            return $resultRedirect->setPath('*/*/');
        }

        $rma = $this->rmaFactory->create()->load($rmaId);
        $initialStatusId = $rma->getStatusId();
        $rmaData = array_replace($rma->getData(), $data);

        unset($rmaData['created_at']);
        unset($rmaData['updated_at']);
        $rma->setData($rmaData);
        if ($topStatusId = $this->getRequest()->getParam('top_status_id')) {
            $rma->setStatusId($topStatusId);
        }

        try {
            $rma->save();
            if ($initialStatusId != $rma->getStatusId()) {
                $this->rmaManager->notifyStatusChangeToCustomer($rma);
                $this->messageManager->addSuccess(__('Return status was successfully changed.'));
            }
            $this->messageManager->addSuccess(__('Return was successfully saved.'));

            if ($back == 'edit') {
                return $resultRedirect->setPath('*/*/' . $back, ['id' => $rma->getId(), '_current' => true]);
            }

            return $resultRedirect->setPath('*/*/');
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while saving the return.'));
        }

        return $resultRedirect->setPath('*/*/edit', ['id' => $rmaId]);
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('WebPanda_Rma::rma_edit');
    }
}
