<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\Source\Rma;

use WebPanda\Rma\Helper\Config as ConfigHelper;
use Magento\Framework\Registry;

/**
 * Class ItemCondition
 * @package WebPanda\Rma\Model\Source\Rma
 */
class ItemCondition implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var null|array
     */
    protected $options = null;

    /**
     * @var null|array
     */
    protected $optionArray = null;

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
     * ItemCondition constructor.
     * @param ConfigHelper $configHelper
     * @param Registry $registry
     */
    public function __construct(
        ConfigHelper $configHelper,
        Registry $registry
    ) {
        $this->configHelper = $configHelper;
        $this->coreRegistry = $registry;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->optionArray === null) {
            $this->optionArray = [];
            foreach ($this->getOptions() as $value => $label) {
                $this->optionArray[] = ['value' => $value, 'label' => $label];
            }
        }
        return $this->optionArray;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        if ($this->options === null) {
            $rma = $this->coreRegistry->registry('rma_request');
            if ($rma && $rma->getStoreId()) {
                $itemConditions = $this->configHelper->getItemConditionOptions($rma->getStoreId());
            } else {
                $itemConditions = $this->configHelper->getItemConditionOptions('default');
            }
            foreach ($itemConditions as $key => $value) {
                $this->options[$key] = $value;
            }
        }
        return $this->options;
    }

    /**
     * @param int $value
     * @return null
     */
    public function getOptionByValue($value)
    {
        $options = $this->getOptions();
        if (array_key_exists($value, $options)) {
            return $options[$value];
        }
        return null;
    }
}
