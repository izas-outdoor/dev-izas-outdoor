<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Status;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
use WebPanda\Rma\Model\Source\Rma\Status as SourceStatus;

/**
 * Class Edit
 * @package WebPanda\Rma\Block\Adminhtml\Status
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * @var Registry|null
     */
    protected $coreRegistry = null;

    /**
     * Edit constructor.
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize form
     * Add standard buttons
     * Add "Save and Continue" button
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_status';
        $this->_blockGroup = 'WebPanda_Rma';

        parent::_construct();

        $status = $this->coreRegistry->registry('rma_status');
        if (!$status->getId() || in_array($status->getId(), SourceStatus::getCoreStatuses())) {
            $this->buttonList->remove('delete');
        }

        $this->buttonList->remove('reset');
        $this->buttonList->add(
            'save_and_continue_edit',
            [
                'class' => 'save',
                'label' => __('Save and Continue Edit'),
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ]
            ],
            10
        );
    }
}
