<?php
namespace Izas\Theme\Block\Html\Header;

/**
 * Class Logo
 * @package Izas\Theme\Block\Html\Header
 */
class Logo extends \Magento\Theme\Block\Html\Header\Logo
{
    /**
     * @inheritdoc
     */
    protected function _getLogoUrl()
    {
        if ($this->getLogoFile()) {
            $url = $this->getViewFileUrl($this->getLogoFile());
        } else {
            $folderName = \Magento\Config\Model\Config\Backend\Image\Logo::UPLOAD_DIR;
            $storeLogoPath = $this->_scopeConfig->getValue(
                'design/header/logo_src',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            $path = $folderName . '/' . $storeLogoPath;
            $logoUrl = $this->_urlBuilder
                    ->getBaseUrl(['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]) . $path;

            if ($storeLogoPath !== null && $this->_isFile($path)) {
                $url = $logoUrl;
            } else {
                $url = $this->getViewFileUrl('images/logo.svg');
            }
        }

        return $url;
    }
}
