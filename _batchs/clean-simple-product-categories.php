<?php
error_reporting(1);
ini_set('display_errors', 1);
set_time_limit(0);
ini_set('memory_limit', '2048M');

use Magento\Framework\App\Bootstrap;

/**
 * If your external file is in root folder
 */
require __DIR__ . '/../app/bootstrap.php';

/**
 * If your external file is NOT in root folder
 * Let's suppose, your file is inside a folder named 'xyz'
 *
 * And, let's suppose, your root directory path is
 * /var/www/html/magento2
 */
// $rootDirectoryPath = '/var/www/html/magento2';
// require $rootDirectoryPath . '/app/bootstrap.php';

$params = $_SERVER;
$bootstrap = Bootstrap::create(BP, $params);
$objectManager = $bootstrap->getObjectManager();

// Set Area Code
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML); // or \Magento\Framework\App\Area::AREA_FRONTEND, depending on your need

// Define Zend Logger
$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/clean-simple-product-categories.log');
$logger = new \Zend\Log\Logger();
/* @var $logger Laminas\Log\Logger */
$logger->addWriter($writer);

$productCollection = $objectManager->create('\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
$pCollection = $productCollection->create()
    ->addAttributeToSelect('*')
    ->addAttributeToFilter('visibility', array('eq' => array(1)));


$categoryCollection = $objectManager->create('\Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
$cCollection = $categoryCollection->create();

$categoryLinkRepository = $objectManager->get('\Magento\Catalog\Model\CategoryLinkRepository');

foreach ($pCollection as $product) {
    $productCategories = $product->getCategoryIds();
    if (count($productCategories)) {
        foreach ($cCollection as $category) {
            if (in_array($category->getId(), $productCategories)) {
                $categoryLinkRepository->deleteByIds($category->getId(), $product->getSku());
                $logger->info(sprintf("Removing %s product sku %s from category id %s", $product->getTypeId(), $product->getSku(), $category->getId()));
            }
        }
    }


}
