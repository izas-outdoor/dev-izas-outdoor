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



namespace Lof\Rma\Block\Adminhtml\Status;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_objectId = 'status_id';
        $this->_controller = 'adminhtml_status';
        $this->_blockGroup = 'Lof_Rma';

        $this->buttonList->remove('save');

        $this->getToolbar()->addChild(
            'update-split-button',
            'Magento\Backend\Block\Widget\Button\SplitButton',
            [
                'label'   => __('Save'),
                'options' => [
                    [
                        'label'          => __('Save'),
                        'default'        => true,
                        'data_attribute' => [
                            'mage-init' => [
                                'button' => [
                                    'event'  => 'save',
                                    'target' => '#edit_form',
                                ],
                            ],
                        ],
                    ],
                    [
                        'label'          => __('Save & Continue Edit'),
                        'data_attribute' => [
                            'mage-init' => [
                                'button' => [
                                    'event'  => 'saveAndContinueEdit',
                                    'target' => '#edit_form',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        return $this;
    }
}
