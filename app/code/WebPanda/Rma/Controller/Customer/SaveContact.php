<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Customer;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class SaveContact
 * @package WebPanda\Rma\Controller\Customer
 */
class SaveContact extends \WebPanda\Rma\Controller\Customer
{
    /**
     * @return $this
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$this->validateFormKey()) {
            return $resultRedirect->setPath('*/*/');
        }

        if ($data) {
            $rmaId = $data['rma_id'];
            unset($data['form_key']);
            unset($data['rma_id']);

            try {
                $this->rmaManager->savePackingSlip($rmaId, $data);
                $this->messageManager->addSuccess(__('Contact information was saved.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong.'));
            }

            return $resultRedirect->setPath('*/*/view', ['id' => $rmaId]);
        }

        return $this->goBack();
    }
}
