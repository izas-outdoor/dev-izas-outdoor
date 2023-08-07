<?php
namespace Izas\Catalog\Block\Product\View;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\View\Element\Template;

/**
 * Class Size
 * @package Izas\Catalog\Block\Product\View
 */
class Size extends Template
{
    /**
     * @var DirectoryList $directoryList
     */
    protected $directoryList;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * Size constructor.
     * @param Context $context
     * @param Registry $registry
     * @param DirectoryList $directoryList
     * @param array $data
     */
    public function __construct(Context $context, Registry $registry, DirectoryList $directoryList, array $data = [])
    {
        $this->directoryList = $directoryList;
        $this->registry = $registry;
        parent::__construct($context, $data);
        $this->setCacheLifetime(86400);
    }

    /**
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $key = parent::getCacheKeyInfo();
        $key[] = $this->getProduct()->getId();

        return $key;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->registry->registry('current_product');
    }

    /**
     * @return bool|string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getSizeGuidePath()
    {
        $product = $this->getProduct();

        return str_replace(" ", "", strtolower('wysiwyg/sizechart/' . $product->getSizechart()));
    }

    /**
     * @return bool
     */
    public function showSizeGuide()
    {
        $product = $this->getProduct();
        if (!$product->getSizechart()) {
            return false;
        }

        $filePath = $this->getSizeGuidePath();

        return file_exists($this->directoryList->getPath('media') . DIRECTORY_SEPARATOR . $filePath);
    }
}
