<?php
namespace Izas\ContentManager\Block\Banner;

use Magento\Framework\View\Element\Template;

/**
 * Class Render
 * @package Izas\ContentManager\Block\Banner
 */
class Render extends Template
{
    /**
     * Render constructor.
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }


    /**
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $cacheKey = parent::getCacheKeyInfo();
        $cacheKey[] = $this->getItem()->getBanner()->getId();
        $cacheKey[] = $this->getItem()->getImageType();
        return  $cacheKey;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        if (is_null($this->_template)) {
            $this->setTemplate('Izas_ContentManager::banner/render/' . $this->getData('type') . '.phtml');
        }

        return $this->_template;
    }
}
