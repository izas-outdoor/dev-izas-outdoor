<?php


namespace Metagento\Faq\Block;


class Head extends
    \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Metagento\Faq\Model\Template $template,
        array $data
    ) {
        $this->_faqTemplate = $template;
        \Magento\Framework\View\Element\Template::__construct($context, $data);
    }

    public function getJsUrl()
    {
        $jsUrl  = array();
        $jsPath = $this->_faqTemplate->getJsPath();
        if ( count($jsPath) ) {
            foreach ( $jsPath as $item ) {
                $jsUrl[] = $this->getViewFileUrl($item);
            }
        }
        return $jsUrl;
    }

    public function getCssUrl()
    {
        $cssUrl  = array();
        $cssPath = $this->_faqTemplate->getCssPath();
        if ( count($cssPath) ) {
            foreach ( $cssPath as $item ) {
                $cssUrl[] = $this->getViewFileUrl($item);
            }
        }
        return $cssUrl;
    }

    public function getCustomCss()
    {
        return $this->_faqTemplate->getCustomCss();
    }

}