<?php
namespace Izas\Catalog\Block\Product\View;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;
use Blackbird\ContentManager\Api\Data\ContentInterface;

/**
 * Class Technology
 * @package Izas\Catalog\Block\Product\View
 */
class Technology extends Template
{
    const IMAGE_FOLDER = 'wysiwyg/technology/';

    /**
     * @var \Magento\Catalog\Model\Product
     */
    protected $product;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var ContentInterface
     */
    protected $contentInterface;

    /**
     * Technology constructor.
     * @param Template\Context $context
     * @param Registry $registry
     * @param ContentInterface $contentInterface
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        ContentInterface $contentInterface,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->contentInterface = $contentInterface;
        parent::__construct($context, $data);
        $this->setCacheLifetime(86400);
    }

    /**
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $cacheKeyInfo = parent::getCacheKeyInfo();
        $cacheKeyInfo[] = $this->registry->registry('product')->getId();

        return $cacheKeyInfo;
    }

    /**
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        if (is_null($this->product)) {
            $this->product = $this->registry->registry('product');
        }

        return $this->product;
    }

    /**
     * @return array
     */
    public function getTechnologies()
    {
        $technologies = [];
        if ($technology = $this->getProduct()->getTechnology()) {
            $technologyIds = explode(',', $this->getProduct()->getTechnology());
            $collection =  $this->contentInterface->getCollection()
                ->addStoreFilter()
                ->addAttributeToFilter(\Blackbird\ContentManager\Model\Content::STATUS, 1)
                ->addContentTypeFilter('technology')
                ->addAttributeToFilter('technology_technology', ['in' => $technologyIds])
                ->addAttributeToSelect('*');
            $technologies = $collection->getItems();
        }

        return $technologies;
    }

    /**
     * @return string
     */
    protected function getTechnologyMediaPath()
    {
        return $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . self::IMAGE_FOLDER;
    }

    /**
     * @param $technology
     * @param $technologyId
     * @return string
     */
    public function getTechnologyImage($technology, $technologyId)
    {
        return $this->getTechnologyMediaPath() .
            strtolower($technology->setStoreId(0)->getSource()->getOptionText($technologyId)) . '.png';
    }
}