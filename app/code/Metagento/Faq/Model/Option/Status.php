<?php


namespace Metagento\Faq\Model\Option;


class Status implements
    \Magento\Framework\Option\ArrayInterface
{

    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 2;

    public function toOptionArray()
    {
        return array(
            self::STATUS_ENABLED  => __("Enabled"),
            self::STATUS_DISABLED => __("Disabled"),
        );
    }
}