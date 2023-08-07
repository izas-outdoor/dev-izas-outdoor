<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\ResourceModel;

/**
 * Class Status
 * @package WebPanda\Rma\Model\ResourceModel
 */
class Status extends AbstractResource
{
    /**
     * @var array
     */
    protected $attributeCodes = [
        'frontend_label',
        'email_to_customer',
        'email_to_admin',
        'message'
    ];

    /**
     * @var string
     */
    protected $entityRefFieldName = 'status_id';

    /**
     * @var string
     */
    protected $attrTableName = 'wp_rma_status_attribute';

    protected function _construct()
    {
        $this->_init('wp_rma_status', 'id');
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $attributeData = $object->getAttribute();
        if (!$object->getIsEmailCustomer()) {
            $object->setIsEmailCustomer(0);
            $attributeData['email_to_customer'] = [];
        }
        if (!$object->getIsEmailAdmin()) {
            $object->setIsEmailAdmin(0);
            $attributeData['email_to_admin'] = [];
        }
        if (!$object->getIsMessage()) {
            $object->setIsMessage(0);
            $attributeData['message'] = [];
        }
        $object->setAttribute($attributeData);

        return parent::_beforeSave($object);
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $this->updateAttributeValues($object);
        return parent::_afterSave($object);
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        $this->attachAttributeValues($object);
        return parent::_afterLoad($object);
    }
}
