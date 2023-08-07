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
 * Class Add
 * @package WebPanda\Rma\Controller\Guest
 */
class Add extends \WebPanda\Rma\Controller\Guest
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$this->validateFormKey()) {
            return $this->goBack();
        }

        if ($data) {
            try {
                $rma = $this->rmaManager->createRma($data, true);
                $rmaLink = '<a href="' . $this->url->getUrl('*/*/view', ['id' => $rma->getId()]) . '">' . $rma->getIncrementId() . '</a>';
                $this->messageManager->addSuccess(__('Return Request was created %1', $rmaLink));

                if (isset($data['text']) && (strlen($data['text']) > 0)) {
                    $uploadedFileNames = [];
                    $attachments = $this->getRequest()->getFiles('attachments');
                    if ((count($attachments) > 1) || (strlen($attachments[0]['name']) > 0)) {
                        $uploadedFileNames = $this->uploadFiles();
                    }
                    $this->rmaManager->addCustomerReply($rma, $data['text'], $uploadedFileNames,  false);
                }
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Return Request.'));
            }
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*');
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
