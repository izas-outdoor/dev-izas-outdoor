<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Customer;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class Reply
 * @package WebPanda\Rma\Controller\Customer
 */
class Reply extends \WebPanda\Rma\Controller\Customer
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $rmaId = $this->getRequest()->getPost('rma_id');
        $text = $this->getRequest()->getPost('text');

        if (!$rmaId) {
            $this->messageManager->addError(__('Something went wrong.'));
            return $this->goBack();
        }

        $uploadedFileNames = [];
        $attachments = $this->getRequest()->getFiles('attachments');
        if ((count($attachments) > 1) || (strlen($attachments[0]['name']) > 0)) {
            $uploadedFileNames = $this->uploadFiles();
            if (
                empty($uploadedFileNames) ||
                count($this->getRequest()->getFiles('attachments')) != count($uploadedFileNames)
            ) {
                return $this->goBack();
            }
        }
        $rma = $this->rmaManager->getRmaModel($rmaId);
        try {
            $this->rmaManager->addCustomerReply($rma, $text, $uploadedFileNames, true);
            $this->messageManager->addSuccess(__('Message was saved.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while saving the message.'));
        }

        return $this->goBack();
    }

    /**
     * @return boolean|array
     */
    public function uploadFiles()
    {
        $files = $this->getRequest()->getFiles('attachments');
        $mediaDirectory = $this->filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $returnArr = [];

        foreach ($files as $k => $file) {
            $fileName = ($file && array_key_exists('name', $file)) ? $file['name'] : null;
            if ($fileName) {
                if (!$this->configHelper->checkFileSize($file['size'])) {
                    $this->messageManager->addError(__('A file was too big.'));
                    break;
                }
                try {
                    $target = $mediaDirectory->getAbsolutePath(\WebPanda\Rma\Model\Attachment::TEMP_PATH);
                    /** @var $uploader \Magento\MediaStorage\Model\File\Uploader */
                    $uploader = $this->fileUploader->create(['fileId' => 'attachments[' . $k . ']']);
                    // set allowed file extensions
                    $uploader->setAllowedExtensions(['jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'xls']);
                    // allow folder creation
                    $uploader->setAllowCreateFolders(true);
                    // rename file name if already exists
                    $uploader->setAllowRenameFiles(true);

                    // upload file in the specified folder
                    $result = $uploader->save($target);
                    if ($result['file']) {
                        $returnArr[] = $result['file'];
                    } else {
                        $this->messageManager->addError(__('Something went wrong when uploading a file.'));
                        break;
                    }
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                    break;
                }
            }
        }

        return $returnArr;
    }
}
