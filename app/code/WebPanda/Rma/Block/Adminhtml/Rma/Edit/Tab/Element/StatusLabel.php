<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element;

/**
 * Class StatusLabel
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element
 */
class StatusLabel extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    /**
     * @var \WebPanda\Rma\Model\StatusFactory
     */
    protected $statusFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * StatusLabel constructor.
     * @param \Magento\Framework\Data\Form\Element\Factory $factoryElement
     * @param \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection
     * @param \Magento\Framework\Escaper $escaper
     * @param \WebPanda\Rma\Model\StatusFactory $statusFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Data\Form\Element\Factory $factoryElement,
        \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection,
        \Magento\Framework\Escaper $escaper,
        \WebPanda\Rma\Model\StatusFactory $statusFactory,
        \Magento\Framework\Registry $registry,
        $data = []
    ) {
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
        $this->statusFactory = $statusFactory;
        $this->coreRegistry = $registry;
    }

    /**
     * Retrieve Element HTML
     *
     * @return string
     */
    public function getElementHtml()
    {
        $rma = $this->coreRegistry->registry('rma_request');

        if ($this->getValue() && $status = $this->statusFactory->create()->load($this->getValue())) {
            $statusHtml = '<span class="rma-status-color" style="background-color: ' . $status->getColor() . '">' . $status->getName() . '</span>';
        } else {
            $statusHtml = '<span class="rma-status-color" style="background-color: red;">' . $rma->getFinalStatusName() . '</span>';
        }

        $html = $this->getBold() ? '<div class="control-value special">' : '<div class="control-value">';
        $html .= $statusHtml;
        $html .= '<input type=hidden name="status_id" value="' . $rma->getStatusId() . '" />';
        $html .= '</div>';
        $html .= $this->getAfterElementHtml();
        return $html;
    }
}
