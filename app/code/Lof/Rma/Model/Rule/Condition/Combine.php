<?php
/**
 * LandOfCoder
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Venustheme.com license that is
 * available through the world-wide-web at this URL:
 * http://www.venustheme.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   LandOfCoder
 * @package    Lof_Rma
 * @copyright  Copyright (c) 2016 Venustheme (http://www.LandOfCoder.com/)
 * @license    http://www.LandOfCoder.com/LICENSE-1.0.html
 */



namespace Lof\Rma\Model\Rule\Condition;

class Combine extends \Magento\Rule\Model\Condition\Combine
{
    public function __construct(
        \Magento\Rule\Model\Condition\Context $context,
        \Lof\Rma\Model\Rule\Condition\Rma  $conditionRma,
        array $data = []
    ) {
        $this->_conditionRma  = $conditionRma;

        parent::__construct($context, $data);

        $this->setType('Lof\Rma\Model\Rule\Condition\Combine');
    }

    /**
     * {@inheritdoc}
     */
    public function getNewChildSelectOptions()
    {
        $rmaAttributes = $this->_conditionRma->loadAttributeOptions()->getAttributeOption();

        $attributes = [];
        foreach ($rmaAttributes as $code => $label) {
            $attributes[] = [
                'value' => 'Lof\Rma\Model\Rule\Condition\Rma|'.$code,
                'label' => $label,
            ];
        }
        $conditions = parent::getNewChildSelectOptions();
        $conditions = array_merge_recursive(
            $conditions,
            [
                [
                    'value' => 'Lof\Rma\Model\Rule\Condition\Combine',
                    'label' => __('Conditions Combination'),
                ],
                ['label' => __('RMA Attribute'), 'value' => $attributes],
            ]
        );

        return $conditions;
    }

    /**
     * @param array $productCollection
     *
     * @return $this
     */
    public function collectValidatedAttributes($productCollection)
    {
        foreach ($this->getConditions() as $condition) {
            /* @var Product|Combine $condition */
            $condition->collectValidatedAttributes($productCollection);
        }

        return $this;
    }
}
