<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Guest;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class PrintPackingSlip
 * @package WebPanda\Rma\Controller\Guest
 */
class PrintPackingSlip extends \WebPanda\Rma\Controller\Guest
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $rmaId = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $rma = $this->rmaManager->getRmaModel($rmaId);

            return $this->fileFactory->create(
                'RMA #' . $rma->getIncrementId() . '.pdf',
                $this->printPackingSlip->getPdf($rma),
                DirectoryList::VAR_DIR,
                'application/pdf'
            );
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while generating the packing slip.'));
        }

        return $this->goBack();
    }
}