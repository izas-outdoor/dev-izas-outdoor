<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use WebPanda\Rma\Helper\Config;

/**
 * Class Item
 * @package WebPanda\Rma\Model\ResourceModel
 */
class Item extends AbstractDb
{
    /**
     * @var Config
     */
    protected $configHelper;

    /**
     * Item constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param Config $configHelper
     * @param null $connectionName
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        Config $configHelper,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->configHelper = $configHelper;
    }

    /**
     * Define main table
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('wp_rma_item', 'id');
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        if ($reasonLabel = $this->configHelper->getReasonLabel($object->getReasonId(), $object->getRma()->getStoreId())) {
            $object->setReason($reasonLabel);
        }
        if ($itemConditionLabel = $this->configHelper->getItemConditionLabel($object->getItemConditionId(), $object->getRma()->getStoreId())) {
            $object->setItemCondition($itemConditionLabel);
        }
        if ($resolutionLabel = $this->configHelper->getResolutionLabel($object->getResolutionId(), $object->getRma()->getStoreId())) {
            $object->setResolution($resolutionLabel);
        }

        return parent::_beforeSave($object);
    }
}
