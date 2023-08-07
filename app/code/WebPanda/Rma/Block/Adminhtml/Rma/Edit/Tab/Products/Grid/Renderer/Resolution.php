<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products\Grid\Renderer;

use WebPanda\Rma\Helper\Config as ConfigHelper;
use Magento\Framework\Registry;

/**
 * Class Resolution
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products\Grid\Renderer
 */
class Resolution extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * Resolution constructor.
     * @param \Magento\Backend\Block\Context $context
     * @param ConfigHelper $configHelper
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Context $context,
        ConfigHelper $configHelper,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->configHelper = $configHelper;
        $this->coreRegistry = $registry;
    }

    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $rma = $this->coreRegistry->registry('rma_request');

        if ($this->configHelper->canAdminEditResolution($rma->getStatusId(), $rma->getStoreId())) {
            $resolutions = $this->configHelper->getResolutionOptions($rma->getStoreId());

            $selectHtml = '<select class="select admin__control-select" name="items[' . $row->getId() . '][resolution_id]">';
            foreach ($resolutions as $value => $label) {
                $selected = ($row->getResolutionId() == $value) ? ' selected' : '';
                $selectHtml .= '<option value="' . $value . '"' . $selected . '>' . $label . '</option>';
            }
            $selectHtml .= '</select>';

            return $selectHtml;
        } else {
            return $row->getFinalResolution();
        }
    }
}
