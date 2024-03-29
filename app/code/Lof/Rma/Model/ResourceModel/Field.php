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



namespace Lof\Rma\Model\ResourceModel;

class Field extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Lof\Rma\Model\FieldFactory $fieldFactory,
        $resourcePrefix = null
    ) {
        $this->context        = $context;
        $this->resourcePrefix = $resourcePrefix;
        $this->fieldFactory   = $fieldFactory;

        parent::__construct($context, $resourcePrefix);
    }

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init('lof_rma_field', 'field_id');
    }

    /**
     * {@inheritdoc}
     */
    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        /** @var  \Lof\Rma\Model\Field $object */
        if (!$object->getIsMassDelete()) {
        }

        return parent::_afterLoad($object);
    }

    /**
     * {@inheritdoc}
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        /** @var  \Lof\Rma\Model\Field $object */
        if (!$object->getId()) {
            $object->setCreatedAt((new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT));
        }
        $object->setUpdatedAt((new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT));

        if (is_array($object->getData('visible_customer_status'))) {
            $object->setData(
                'visible_customer_status',
                ','.implode(',', $object->getData('visible_customer_status')).','
            );
        }

        return parent::_beforeSave($object);
    }

    /**
     * @param \Lof\Rma\Model\Field $object
     * @return void
     */
    public function afterCommitCallback(\Lof\Rma\Model\Field $object)
    {
        if ($object->isObjectNew()) {
            $resource = $this->context->getResources();
            $writeConnection = $resource->getConnection('core_write');
            $tableName = $resource->getTableName('lof_rma_rma');
            $fieldType = 'TEXT';
            if ($object->getType() == 'date') {
                $fieldType = 'TIMESTAMP';
            }
            $query = "ALTER TABLE `{$tableName}` ADD `{$object->getCode()}` ".$fieldType;
            $writeConnection->query($query);
            $writeConnection->resetDdlCache();
        }
    }

    /************************/

    /**
     * @var string
     */
    protected $dbCode;

    /**
     * {@inheritdoc}
     */
    protected function _beforeDelete(\Magento\Framework\Model\AbstractModel $object)
    {
        /* @var \Lof\Rma\Model\Field  $object */
        $field = $this->fieldFactory->create()->load($object->getId());
        $this->dbCode = $field->getCode();

        return parent::_beforeDelete($object);
    }

    /**
     * @param \Lof\Rma\Model\Field $object
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @return void
     */
    public function afterDeleteCommit(\Lof\Rma\Model\Field  $object)
    {
        $resource = $this->context->getResources();
        $writeConnection = $resource->getConnection('core_write');
        $tableName = $resource->getTableName('lof_rma_rma');
        $query = "ALTER TABLE `{$tableName}` DROP `{$this->dbCode}`";
        $writeConnection->query($query);
        $writeConnection->resetDdlCache();
    }
}
