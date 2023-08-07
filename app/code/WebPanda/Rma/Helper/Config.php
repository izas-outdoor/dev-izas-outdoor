<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;

/**
 * Class Config
 * @package WebPanda\Rma\Helper
 */
class Config extends AbstractHelper
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var JsonSerializer
     */
    protected $serializer;

    /**
     * @var array
     */
    protected $resolutionOptions = [];

    /**
     * @var array
     */
    protected $itemConditionOptions = [];

    /**
     * @var array
     */
    protected $reasonOptions = [];

    /**
     * Config constructor.
     * @param Context $context
     * @param JsonSerializer $serializer
     */
    public function __construct(
        Context $context,
        JsonSerializer $serializer
    ) {
        parent::__construct($context);
        $this->scopeConfig = $context->getScopeConfig();
        $this->serializer = $serializer;
    }

    public function getGuest()
    {
        return $this->scopeConfig->getValue('rma/default/guest');
    }

    public function getStatusDropdown()
    {
        return $this->scopeConfig->getValue('rma/default/status_dropdown');
    }

    public function getReturnPeriod()
    {
        return $this->scopeConfig->getValue('rma/default/return_period', ScopeInterface::SCOPE_STORE);
    }

    public function getOrderStatuses()
    {
        $value = $this->scopeConfig->getValue('rma/default/order_statuses', ScopeInterface::SCOPE_STORE);
        return is_array($value) ? $value : explode(',', $value);
    }

    public function getMaxAttachmentSize()
    {
        return $this->scopeConfig->getValue('rma/default/max_attachment_size', ScopeInterface::SCOPE_STORE);
    }

    public function getReturnInstructionsBlock()
    {
        return $this->scopeConfig->getValue('rma/default/return_instructions_block', ScopeInterface::SCOPE_STORE);
    }

    public function getConfirmShipmentPopupText()
    {
        return $this->scopeConfig->getValue('rma/default/confirm_shipping_popup_text', ScopeInterface::SCOPE_STORE);
    }

    public function getRmaDepartmentName($storeId = null)
    {
        return $this->scopeConfig->getValue('rma/contact/name', ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getRmaDepartmentEmail($storeId = null)
    {
        return $this->scopeConfig->getValue('rma/contact/email', ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getRmaDepartmentAddress($storeId = null)
    {
        return $this->scopeConfig->getValue('rma/contact/address', ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getNotifyCustomer($storeId = null)
    {
        return $this->scopeConfig->getValue('rma/contact/notify_customer', ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getNotifyAdmin($storeId = null)
    {
        return $this->scopeConfig->getValue('rma/contact/notify_admin', ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getNotifyCustomerAdminCommentTemplate($storeId = null)
    {
        return $this->scopeConfig->getValue('rma/email_templates/notify_customer_admin_comment_template', ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getNotifyAdminCustomerCommentTemplate($storeId = null)
    {
        return $this->scopeConfig->getValue('rma/email_templates/notify_admin_customer_comment_template', ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getReasonFrontendLabel()
    {
        return $this->scopeConfig->getValue('rma/reason/frontend_label', ScopeInterface::SCOPE_STORE);
    }

    public function getReasonAdminCanEditAt($storeId = null)
    {
        $value = $this->scopeConfig->getValue('rma/reason/admin_can_edit_at', ScopeInterface::SCOPE_STORE, $storeId);
        return is_array($value) ? $value : explode(',', $value);
    }

    public function getReasonCustomerCanEditAt($storeId = null)
    {
        $value = $this->scopeConfig->getValue('rma/reason/customer_can_edit_at', ScopeInterface::SCOPE_STORE, $storeId);
        return is_array($value) ? $value : explode(',', $value);
    }

    public function getReasonOptions($storeId = null)
    {
        if (isset($this->reasonOptions[$storeId])) {
            return $this->reasonOptions[$storeId];
        }
        $configData = $this->serializer->unserialize($this->scopeConfig->getValue('rma/reason/options', ScopeInterface::SCOPE_STORE, $storeId));
        $this->reasonOptions[$storeId] = [];
        foreach ($configData as $key => $config) {
            $this->reasonOptions[$storeId][$key] = $config['options'];
        }

        return $this->reasonOptions[$storeId];
    }

    public function getReasonLabel($reasonId, $storeId = null)
    {
        $reasonOptions = $this->getReasonOptions($storeId);
        return isset($reasonOptions[$reasonId]) ? $reasonOptions[$reasonId] : false;
    }

    public function canAdminEditReason($statusId, $storeId = null)
    {
        $allowedStatuses = $this->getReasonAdminCanEditAt($storeId);
        return in_array($statusId, $allowedStatuses);
    }

    public function canCustomerEditReason($statusId, $storeId = null)
    {
        $allowedStatuses = $this->getReasonCustomerCanEditAt($storeId);
        return in_array($statusId, $allowedStatuses);
    }

    public function getItemConditionFrontendLabel()
    {
        return $this->scopeConfig->getValue('rma/item_condition/frontend_label', ScopeInterface::SCOPE_STORE);
    }

    public function getItemConditionAdminCanEditAt($storeId = null)
    {
        $value = $this->scopeConfig->getValue('rma/item_condition/admin_can_edit_at', ScopeInterface::SCOPE_STORE, $storeId);
        return is_array($value) ? $value : explode(',', $value);
    }

    public function getItemConditionCustomerCanEditAt($storeId = null)
    {
        $value = $this->scopeConfig->getValue('rma/item_condition/customer_can_edit_at', ScopeInterface::SCOPE_STORE, $storeId);
        return is_array($value) ? $value : explode(',', $value);
    }

    public function getItemConditionOptions($storeId = null)
    {
        if (isset($this->itemConditionOptions[$storeId])) {
            return $this->itemConditionOptions[$storeId];
        }
        $configData = $this->serializer->unserialize($this->scopeConfig->getValue('rma/item_condition/options', ScopeInterface::SCOPE_STORE, $storeId));
        $this->itemConditionOptions[$storeId] = [];
        foreach ($configData as $key => $config) {
            $this->itemConditionOptions[$storeId][$key] = $config['options'];
        }

        return $this->itemConditionOptions[$storeId];
    }

    public function getItemConditionLabel($itemConditionId, $storeId = null)
    {
        $itemConditionOptions = $this->getItemConditionOptions($storeId);
        return isset($itemConditionOptions[$itemConditionId]) ? $itemConditionOptions[$itemConditionId] : false;
    }

    public function canAdminEditItemCondition($statusId, $storeId = null)
    {
        $allowedStatuses = $this->getItemConditionAdminCanEditAt($storeId);
        return in_array($statusId, $allowedStatuses);
    }

    public function canCustomerEditItemCondition($statusId, $storeId = null)
    {
        $allowedStatuses = $this->getItemConditionCustomerCanEditAt($storeId);
        return in_array($statusId, $allowedStatuses);
    }

    public function getResolutionFrontendLabel()
    {
        return $this->scopeConfig->getValue('rma/resolution/frontend_label', ScopeInterface::SCOPE_STORE);
    }

    public function getResolutionAdminCanEditAt($storeId = null)
    {
        $value = $this->scopeConfig->getValue('rma/resolution/admin_can_edit_at', ScopeInterface::SCOPE_STORE, $storeId);
        return is_array($value) ? $value : explode(',', $value);
    }

    public function getResolutionCustomerCanEditAt($storeId = null)
    {
        $value = $this->scopeConfig->getValue('rma/resolution/customer_can_edit_at', ScopeInterface::SCOPE_STORE, $storeId);
        return is_array($value) ? $value : explode(',', $value);
    }

    public function getResolutionOptions($storeId = null)
    {
        if (isset($this->resolutionOptions[$storeId])) {
            return $this->resolutionOptions[$storeId];
        }
        $configData = $this->serializer->unserialize($this->scopeConfig->getValue('rma/resolution/options', ScopeInterface::SCOPE_STORE, $storeId));
        $this->resolutionOptions[$storeId] = [];
        foreach ($configData as $key => $config) {
            $this->resolutionOptions[$storeId][$key] = $config['options'];
        }

        return $this->resolutionOptions[$storeId];
    }

    public function getResolutionLabel($resolutionId, $storeId = null)
    {
        $resolutionOptions = $this->getResolutionOptions($storeId);
        return isset($resolutionOptions[$resolutionId]) ? $resolutionOptions[$resolutionId] : false;
    }

    public function canAdminEditResolution($statusId, $storeId = null)
    {
        $allowedStatuses = $this->getResolutionAdminCanEditAt($storeId);
        return in_array($statusId, $allowedStatuses);
    }

    public function canCustomerEditResolution($statusId, $storeId = null)
    {
        $allowedStatuses = $this->getResolutionCustomerCanEditAt($storeId);
        return in_array($statusId, $allowedStatuses);
    }

    /**
     * @param $bytes
     * @return bool
     */
    public function checkFileSize($bytes)
    {
        return ($bytes <= 1048576 * (int)$this->getMaxAttachmentSize());
    }

    /**
     * @param null $storeId
     * @return array
     */
    public function getEmailConfigData($storeId = null)
    {
        $departmentName = $this->getRmaDepartmentName($storeId);
        $departmentEmail = $this->getRmaDepartmentEmail($storeId);
        $templateToCustomer = $this->getNotifyCustomerAdminCommentTemplate($storeId);
        $templateToAdmin = $this->getNotifyAdminCustomerCommentTemplate($storeId);

        return [
            'department' => [
                'name' => $departmentName,
                'email' => $departmentEmail
            ],
            'template' => [
                'to_customer' => $templateToCustomer,
                'to_admin' => $templateToAdmin
            ]
        ];
    }

    public function getSpecialStyle()
    {
        return $this->scopeConfig->getValue('rma/admin_style/confirm_shipping_popup_text', ScopeInterface::SCOPE_STORE);
    }

    public function canCreateRmaForOrder($orderStatus)
    {
        $allowedStatuses = $this->getOrderStatuses();
        return in_array($orderStatus, $allowedStatuses);
    }
}
