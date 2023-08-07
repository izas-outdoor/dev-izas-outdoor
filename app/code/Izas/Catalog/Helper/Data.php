<?php
namespace Izas\Catalog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 * @package Izas\Catalog\Helper
 */
class Data extends AbstractHelper
{
    const XML_PATH_IMAGE_PATH = 'catalog/export_gallery/path';

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_IMAGE_PATH, ScopeInterface::SCOPE_STORES);
    }
}
