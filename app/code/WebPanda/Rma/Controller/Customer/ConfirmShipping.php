<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Customer;

use Magento\Framework\Exception\LocalizedException;
use WebPanda\Rma\Model\Source\Rma\Status;

/**
 * Class ConfirmShipping
 * @package WebPanda\Rma\Controller\Customer
 */
class ConfirmShipping extends \WebPanda\Rma\Controller\Customer
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $rmaId = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $rma = $this->rmaManager->getRmaModel($rmaId);
            $rma->setStatusId(Status::PACKAGE_SENT);
            $rma->save();
            $this->rmaManager->notifyStatusChangeToAdmin($rma);
            $this->messageManager->addSuccess(__('Return status was successfully changed.'));

            return $resultRedirect->setPath('*/*/view', ['id' => $rmaId]);
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while changing status of the return.'));
        }

        return $this->goBack();
    }
}