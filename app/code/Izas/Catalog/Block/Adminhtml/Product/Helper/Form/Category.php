<?php


namespace Izas\Catalog\Block\Adminhtml\Product\Helper\Form;


class Category extends \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Category
{
    /**
     * Get values for select
     *
     * @return array
     */
    public function getValues()
    {
        $collection = $this->_getCategoriesCollection();
        $values = $this->getValue();
        if (!is_array($values)) {
            $values = explode(',', $values);
        }

        $collection->addAttributeToSelect('name');
        $collection->addIdFilter($values);

        $options = [];
        $positions = array_flip($values);

        foreach ($collection as $category) {
            $options[$positions[$category->getId()]] = ['label' => $category->getName(), 'value' => $category->getId()];
        }
        ksort($options);

        return $options;
    }
}
