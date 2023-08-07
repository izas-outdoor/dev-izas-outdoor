<?php
/**
 * Copyright © 2018 Magmodules.eu. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magmodules\GoogleShopping\Block\Adminhtml\System\Config\Form\Field;

use Magento\Framework\DataObject;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

/**
 * Class ExtraFields
 *
 * @package Magmodules\GoogleShopping\Block\Adminhtml\System\Config\Form\Field
 */
class ExtraFields extends AbstractFieldArray
{

    /**
     * @var \Magmodules\GoogleShopping\Block\Adminhtml\System\Config\Form\Field\Renderer\Attributes
     */
    private $attributeRenderer;

    /**
     * Render block
     */
    public function _prepareToRender()
    {
        $this->addColumn('name', [
            'label' => __('Fieldname'),
        ]);
        $this->addColumn('attribute', [
            'label'    => __('Attribute'),
            'renderer' => $this->getAttributeRenderer()
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * @return \Magento\Framework\View\Element\BlockInterface|Renderer\Attributes
     */
    public function getAttributeRenderer()
    {
        if (!$this->attributeRenderer) {
            try {
                $this->attributeRenderer = $this->getLayout()->createBlock(
                    '\Magmodules\GoogleShopping\Block\Adminhtml\System\Config\Form\Field\Renderer\Attributes',
                    '',
                    ['data' => ['is_render_to_js_template' => true]]
                );
            } catch (\Exception $localizedException) {
                $this->attributeRenderer = [];
            }
        }
        return $this->attributeRenderer;
    }

    /**
     * @param DataObject $row
     *
     */
    public function _prepareArrayRow(DataObject $row)
    {
        $attribute = $row->getData('attribute');
        $options = [];
        if ($attribute) {
            $options['option_' . $this->getAttributeRenderer()->calcOptionHash($attribute)] = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
    }
}
