<?php
namespace Izas\ContentManager\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\View\LayoutInterface;
use Magento\Framework\DataObjectFactory;
use Izas\ContentManager\Block\Banner\Render;

/**
 * Class Banner
 * @package Izas\ContentManager\Helper
 */
class Banner extends AbstractHelper
{
    /**
     * @var LayoutInterface
     */
    protected $layout;

    /**
     * @var DataObjectFactory
     */
    protected $objectFactory;

    /**
     * Banner constructor.
     * @param Context $context
     * @param LayoutInterface $layout
     * @param DataObjectFactory $objectFactory
     */
    public function __construct(
        Context $context,
        LayoutInterface $layout,
        DataObjectFactory $objectFactory
    ) {
        $this->layout = $layout;
        $this->objectFactory = $objectFactory;
        parent::__construct($context);
    }

    /**
     * @param $item
     * @param $imageType
     * @param $className
     * @return \Magento\Framework\DataObject
     */
    public function createBannerItem($item, $imageType, $className)
    {
        $banner = $this->objectFactory->create();
        $banner->setBanner($item)->setImageType($imageType)->setClassName($className);

        return $banner;
    }

    /**
     * @param $item
     * @param string $type
     * @param int $ttl
     * @return mixed
     */
    public function getBannerRenderHtml($item, $type = 'default', $ttl = 3600)
    {
        return $this->layout
            ->createBlock(Render::class)
            ->setItem($item)
            ->setType($type)
            ->setCacheLifetime($ttl)
            ->toHtml();
    }

}
