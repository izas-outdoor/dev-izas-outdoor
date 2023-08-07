<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model;

use WebPanda\Rma\Model\RmaFactory;
use WebPanda\Rma\Helper\Config as ConfigHelper;

/**
 * Class Item
 * @package WebPanda\Rma\Model
 */
class Item extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var \WebPanda\Rma\Model\RmaFactory
     */
    protected $rmaFactory;

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    protected $finalReason;

    protected $rma;

    protected $finalResolution;

    protected $finalItemCondition;

    /**
     * Item constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \WebPanda\Rma\Model\RmaFactory $rmaFactory
     * @param ConfigHelper $configHelper
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        RmaFactory $rmaFactory,
        ConfigHelper $configHelper,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
        $this->rmaFactory = $rmaFactory;
        $this->configHelper = $configHelper;
    }

    protected function _construct()
    {
        $this->_init('WebPanda\Rma\Model\ResourceModel\Item');
    }

    public function getRma()
    {
        if ($this->rma == null) {
            $this->rma = $this->rmaFactory->create()->load($this->getRmaId());
        }
        return $this->rma;
    }

    /**
     * @return string
     */
    public function getFinalReason()
    {
        if ($this->finalReason == null) {
            $reasons = $this->configHelper->getReasonOptions($this->getRma()->getStoreId());
            if (isset($reasons[$this->getReasonId()])) {
                $this->finalReason = $reasons[$this->getReasonId()];
            } else {
                $this->finalReason = $this->getReason();
            }
        }

        return $this->finalReason;
    }

    /**
     * @return string
     */
    public function getFinalItemCondition()
    {
        if ($this->finalItemCondition == null) {
            $itemConditions = $this->configHelper->getItemConditionOptions($this->getRma()->getStoreId());
            if (isset($itemConditions[$this->getIemConditionId()])) {
                $this->finalItemCondition = $itemConditions[$this->getItemConditionId()];
            } else {
                $this->finalItemCondition = $this->getItemCondition();
            }
        }

        return $this->finalItemCondition;
    }

    /**
     * @return string
     */
    public function getFinalResolution()
    {
        if ($this->finalResolution == null) {
            $resolutions = $this->configHelper->getResolutionOptions($this->getRma()->getStoreId());
            if (isset($resolutions[$this->getResolutionId()])) {
                $this->finalResolution = $resolutions[$this->getResolutionId()];
            } else {
                $this->finalResolution = $this->getResolution();
            }
        }

        return $this->finalResolution;
    }
}
