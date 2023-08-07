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
use Magento\Framework\Exception\LocalizedException;
use WebPanda\Rma\Model\StatusFactory;
use Magento\Framework\Registry;

/**
 * Class Save
 * @package WebPanda\Rma\Controller\Adminhtml\Status
 */
class Save extends \WebPanda\Rma\Controller\Adminhtml\Status
{
    /**
     * @var StatusFactory
     */
    protected $statusFactory;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        StatusFactory $statusFactory,
        Registry $coreRegistry
    ) {
        parent::__construct($context, $resultPageFactory);
        $this->statusFactory = $statusFactory;
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * @return $this
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $status = $this->statusFactory->create();
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $status->load($id);
            }

            $status->setData($data);
            $back = $this->getRequest()->getParam('back');

            try {
                $status->save();
                if ($id) {
                    $this->messageManager->addSuccess(__('Status was updated.'));
                } else {
                    $this->messageManager->addSuccess(__('Status was added.'));
                }
                $this->_getSession()->setFormData(false);

                if ($back == 'edit') {
                    return $resultRedirect->setPath('*/*/' . $back, ['id' => $status->getId(), '_current' => true]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the status.'));
            }
            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
