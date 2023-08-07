<?php


namespace Metagento\Faq\Model\Option;


class Category implements
    \Magento\Framework\Option\ArrayInterface
{
    public function __construct(
        \Metagento\Faq\Model\CategoryFactory $categoryFactory
    ) {
        $this->_cattegoryFactory = $categoryFactory;
    }


    public function toOptionArray()
    {
        $collection = $this->_cattegoryFactory->create()->getCollection();
        $options    = array();
        foreach ( $collection as $category ) {
            $options[$category->getId()] = $category->getName();
        }
        return $options;
    }

    public function toOptionHash()
    {
        $option = $this->toOptionArray();
        $hash   = array();
        foreach ( $option as $index => $value ) {
            $hash[] = array(
                'value' => $index,
                'label' => $value
            );
        }
        return $hash;
    }
}