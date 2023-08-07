<?php

namespace Omnisend\Omnisend\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class WebsiteButton extends Field
{
    const OMNISEND_WEBSITE_URL = "https://app.omnisend.com";
    const WEBSITE_BUTTON_TEMPLATE = 'system/config/website_button.phtml';

    /**
     * @var string
     */
    protected $websiteButtonLabel = 'Go to Omnisend';

    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();

        return parent::render($element);
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if (!$this->getTemplate()) {
            $this->setTemplate(self::WEBSITE_BUTTON_TEMPLATE);
        }

        return $this;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $originalData = $element->getOriginalData();
        $label = !empty($originalData['button_label']) ? $originalData['button_label'] : $this->websiteButtonLabel;

        $this->addData(
            [
                'button_label' => __($label),
                'html_id' => $element->getHtmlId(),
                'website_url' => self::OMNISEND_WEBSITE_URL
            ]
        );

        return $this->_toHtml();
    }
}