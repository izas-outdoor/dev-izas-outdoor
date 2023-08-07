<?php
namespace Izas\Catalog\Controller\Adminhtml\Gallery;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\DirectoryList as Dir;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Ui\Component\MassAction\Filter;
use Exception;
use Izas\Catalog\Helper\Data as HelperData;
use Izas\Catalog\Logger\Logger;

/**
 * Class Export
 * @package Izas\Catalog\Controller\Adminhtml\Gallery
 */
class Export extends Action
{
    const ADMIN_RESOURCE = 'Magento_Catalog::path';

    /**
     * @var HelperData
     */
    protected $helperData;

    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var Dir
     */
    protected $directoryList;

    /**
     * @var Filesystem
     */
    protected $fileSystem;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Export constructor.
     * @param Context $context
     * @param HelperData $helperData
     * @param Filter $filter
     * @param CollectionFactory $productCollectionFactory
     * @param Filesystem $fileSystem
     * @param Dir $directoryList
     * @param Logger $logger
     */
    public function __construct(
        Context $context,
        HelperData $helperData,
        Filter $filter,
        CollectionFactory $productCollectionFactory,
        Filesystem $fileSystem,
        Dir $directoryList,
        Logger $logger
    ) {
        $this->helperData = $helperData;
        $this->filter = $filter;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->fileSystem = $fileSystem;
        $this->directoryList = $directoryList;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function getProductCollection()
    {
        return $this->filter->getCollection(
            $this->productCollectionFactory->create()
        )->addMediaGalleryData();
    }

    /**
     * @param $file
     * @return string
     */
    protected function getFileSource($file)
    {
        $reader = $this->fileSystem->getDirectoryRead(DirectoryList::MEDIA);
        return $reader->getAbsolutePath() . 'catalog/product' . $file;
    }

    /**
     * @param $destinationFolder
     * @param $sku
     * @param $img
     * @return string
     */
    protected function getFileDestination($destinationFolder, $sku, $img)
    {
        $fileParts = explode('.', $img['file']);
        return $destinationFolder . '/' . $sku . '_' . $img['position'].'.' . $fileParts[1];
    }

    /**
     * @param $message
     * @return $this
     */
    protected function log($message)
    {
        $this->logger->info($message);
        return $this;
    }

    /**
     * @param $product
     * @return string|string[]
     */
    protected function getProductSku($product)
    {
        return str_replace('/', '_', $product->getSku());
    }

    /**
     * @return string
     */
    protected function getDestination()
    {
        $destination = $this->directoryList->getRoot() . DIRECTORY_SEPARATOR . $this->helperData->getPath();
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        return $destination;
    }

    /**
     * @param $source
     * @param $destination
     * @param $sku
     * @return bool
     */
    protected function copyFile($source, $destination, $sku)
    {
        $success = false;
        if (file_exists($source)) {
            $success = copy($source, $destination);
        } else {
            $this->log('Image for product ' . $sku . ' not found. File path: ' . $source);
        }

        return $success;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->getProductCollection();
        foreach ($collection as $product) {
            try {
                $gallery = $product->getMediaGallery();
                if (!empty($gallery['images'])) {
                    $sku = $this->getProductSku($product);
                    $destinationFolder = $this->getDestination();
                    foreach ($gallery['images'] as $img) {
                        $file = $img['file'];
                        $source = $this->getFileSource($file);
                        $destination = $this->getFileDestination($destinationFolder, $sku, $img);
                        if (!$this->copyFile($source, $destination, $product->getSku())) {
                            $this->log('Error while copying image for' . $product->getSku(). '. File:' . $source);
                        }
                    }
                } else {
                    $this->log('Product ' . $product->getSku() . 'doesn\'t have any image.');
                }
            } catch (Exception $e) {
                $this->log($e->getMessage());
            }
        }
    }
}
