<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Guest;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class Update
 * @package WebPanda\Rma\Controller\Guest
 */
class Update extends \WebPanda\Rma\Controller\Guest
{
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$this->validateFormKey()) {
            return $this->goBack();
        }

        if ($data) {
            $rmaItemId = $data['id'];

            try {
                $item = $this->itemFactory->create()->load($rmaItemId);
                $rma = $item->getRma();
                if (
                    isset($data['reason_id']) &&
                    !$this->configHelper->canCustomerEditReason($rma->getStatusId())
                ) {
                    throw new LocalizedException(__('You are not allowed to edit the Reason for Return'));
                }
                if (
                    isset($data['item_condition_id']) &&
                    !$this->configHelper->canCustomerEditItemCondition($rma->getStatusId())
                ) {
                    throw new LocalizedException(__('You are not allowed to edit the Item Condition'));
                }
                if (
                    isset($data['resolution_id']) &&
                    !$this->configHelper->canCustomerEditResolution($rma->getStatusId())
                ) {
                    throw new LocalizedException(__('You are not allowed to edit the Resolution'));
                }

                $item->setData(array_replace($rma->getData(), $data));
                $item->save();
                $this->messageManager->addSuccess(__('Return Request was updated.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Return Request.'));
            }
        }

        return $this->goBack();
    }
}
