<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma;

use WebPanda\Rma\Model\Source\Rma\Status;
use WebPanda\Rma\Helper\Config as ConfigHelper;

/**
 * Class Edit
 * @package WebPanda\Rma\Block\Adminhtml\Rma
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        ConfigHelper $configHelper,
        array $data = [])
    {
        $this->coreRegistry = $registry;
        $this->configHelper = $configHelper;
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
        $this->_controller = 'adminhtml_rma';
        $this->_blockGroup = 'WebPanda_Rma';

        parent::_construct();

        $rma = $this->coreRegistry->registry('rma_request');

        $this->buttonList->remove('delete');
        $this->buttonList->remove('reset');
        $this->buttonList->add(
            'save_and_continue_edit',
            [
                'class' => 'save',
                'label' => __('Save and Continue Edit'),
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ]
            ]
        );

        if (in_array($rma->getStatusId(), [Status::CANCELED, Status::COMPLETE])) {
            if (!$this->configHelper->getStatusDropdown()) {
                $this->buttonList->remove('save');
                $this->buttonList->remove('save_and_continue_edit');
            }
            return;
        }

        $this->buttonList->add(
            'cancel',
            [
                'label' => __("Cancel"),
                'class' => 'cancel',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'save',
                            'target' => '#edit_form',
                            'eventData' => [
                                'action' => ['args' => ['top_status_id' => Status::CANCELED, 'back' => 'edit']]],
                        ],
                    ],
                ]
            ]
        );

        $this->buttonList->update('save', 'class', 'save');

        $this->addMainButton($rma);
    }

    protected function addMainButton($rma)
    {
        $nextStatus = false;

        switch ($rma->getStatusId()) {
            case Status::PENDING_APPROVAL:
                $nextStatus = Status::APPROVED;
                $buttonLabel = __('Approve');
                break;
            case Status::APPROVED:
            case Status::PACKAGE_SENT:
                $nextStatus = Status::PACKAGE_RECEIVED;
                $buttonLabel = __('Confirm Package Receiving');
                break;
            case Status::ISSUED_REFUND:
            case Status::PACKAGE_RECEIVED:
                $nextStatus = Status::COMPLETE;
                $buttonLabel = __('Complete');
                break;
        }

        if ($rma->getStatusId() == Status::PACKAGE_RECEIVED) {
            if ($this->_isAllowedAction('Magento_Sales::creditmemo') && $rma->getOrder()->canCreditmemo()) {
                $this->buttonList->add(
                    'credit_memo',
                    [
                        'class' => 'save',
                        'label' => __('Credit Memo'),
                        'onclick' => 'setLocation(\'' . $this->getCreditMemoUrl($rma) . '\')'
                    ],
                    11
                );
            }
            $this->buttonList->add(
                'issued_refund',
                [
                    'class' => 'save',
                    'label' => __('Issued Refund'),
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => [
                                'event' => 'save',
                                'target' => '#edit_form',
                                'eventData' => ['action' => ['args' => ['top_status_id' => Status::ISSUED_REFUND, 'back' => 'edit']]],
                            ],
                        ],
                    ]
                ],
                12
            );
        }

        if ($nextStatus) {
            $this->buttonList->add(
                'primaryaction',
                [
                    'label' => $buttonLabel,
                    'class' => 'primary',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => [
                                'event' => 'save',
                                'target' => '#edit_form',
                                'eventData' => ['action' => ['args' => ['top_status_id' => $nextStatus, 'back' => 'edit']]],
                            ],
                        ],
                    ]
                ]
            );
        }
    }

    /**
     * Retrieve credit memo url
     *
     * @param $rma
     * @return string
     */
    protected function getCreditMemoUrl($rma)
    {
        return $this->getUrl('sales/order_creditmemo/start', ['order_id' => $rma->getOrderId()]);
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
