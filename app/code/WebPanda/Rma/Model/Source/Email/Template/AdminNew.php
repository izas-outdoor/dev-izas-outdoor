<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\Source\Email\Template;

/**
 * Class AdminNew
 * @package WebPanda\Rma\Model\Source\Email\Template
 */
class AdminNew implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Config\Model\Config\Source\Email\Template
     */
    protected $emailTemplates;

    /**
     * Customer constructor.
     * @param \Magento\Config\Model\Config\Source\Email\Template $emailTemplates
     */
    public function __construct(
        \Magento\Config\Model\Config\Source\Email\Template $emailTemplates
    ) {
        $this->emailTemplates = $emailTemplates;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $path = 'rma_email_templates_notify_admin_new_rma_template';
        return $this->emailTemplates->setPath($path)->toOptionArray();
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        $options = [];
        foreach ($this->toOptionArray() as $option) {
            $options[$option['value']] = $option['label'];
        }
        return $options;
    }

    /**
     * @param int $value
     * @return null
     */
    public function getOptionByValue($value)
    {
        $options = $this->getOptions();
        if (array_key_exists($value, $options)) {
            return $options[$value];
        }
        return null;
    }
}
