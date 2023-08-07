<?php


namespace Metagento\Faq\Model\Option;


class Template implements
    \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return array(
            '1' => __("Template 1"),
            '2' => __("Template 2"),
        );
    }
}