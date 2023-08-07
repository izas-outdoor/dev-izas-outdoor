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
use Magento\Framework\Controller\ResultFactory;
use WebPanda\Rma\Model\RmaManager;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use WebPanda\Rma\Helper\Config as ConfigHelper;

/**
 * Class Reply
 * @package WebPanda\Rma\Controller\Adminhtml\Rma
 */
class Reply extends \WebPanda\Rma\Controller\Adminhtml\Rma
{
    /**
     * @var RmaManager
     */
    protected $rmaManager;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var UploaderFactory
     */
    protected $fileUploader;

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * Reply constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param RmaManager $rmaManager
     * @param Filesystem $filesystem
     * @param UploaderFactory $fileUploader
     * @param ConfigHelper $configHelper
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        RmaManager $rmaManager,
        Filesystem $filesystem,
        UploaderFactory $fileUploader,
        ConfigHelper $configHelper
    ) {
        parent::__construct($context, $resultPageFactory);
        $this->rmaManager = $rmaManager;
        $this->filesystem = $filesystem;
        $this->fileUploader = $fileUploader;
        $this->configHelper = $configHelper;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $rmaId = $this->getRequest()->getPost('rma_id');
        $text = $this->getRequest()->getPost('text');
        $sendMail = $this->getRequest()->getPost('reply_send_email');

        if (!$rmaId) {
            $this->messageManager->addError(__('Something went wrong.'));
            return $resultRedirect->setPath('*/*/');
        }

        $uploadedFileNames = [];
        $attachments = $this->getRequest()->getFiles('attachments');
        if ((count($attachments) > 1) || (strlen($attachments[0]['name']) > 0)) {
            $uploadedFileNames = $this->uploadFiles();
            if (
                empty($uploadedFileNames) ||
                count($this->getRequest()->getFiles('attachments')) != count($uploadedFileNames)
            ) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $rmaId]);
            }
        }
        $rma = $this->rmaManager->getRmaModel($rmaId);
        try {
            $this->rmaManager->addAdminReply($rma, $text, $uploadedFileNames,  (bool)$sendMail);
            $this->messageManager->addSuccess(__('Message was saved.'));

            return $resultRedirect->setPath('*/*/edit', ['id' => $rmaId, '_current' => true]);
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while saving the message.'));
        }

        return $resultRedirect->setPath('*/*/edit', ['id' => $rmaId]);
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

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('WebPanda_Rma::rma_edit');
    }
}
