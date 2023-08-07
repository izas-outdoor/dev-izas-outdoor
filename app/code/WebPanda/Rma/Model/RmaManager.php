<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model;

use Amasty\Meta\Block\Adminhtml\Widget\Grid\Column\Filter\Store;
use Magento\Framework\Exception\LocalizedException;
use Magento\Backend\Model\Auth\Session;
use Zend\Mail\MessageFactory;
use WebPanda\Rma\Model\MessageFactory as RmaMessageFactory;
use WebPanda\Rma\Model\AttachmentFactory;
use WebPanda\Rma\Helper\Config as ConfigHelper;
use WebPanda\Rma\Helper\Data as DataHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use WebPanda\Rma\Model\Source\Rma\Status as StatusSource;
use Magento\Sales\Model\OrderFactory;
use Magento\Customer\Model\Session as CustomerSession;

/**
 * Class RmaManager
 * @package WebPanda\Rma\Model
 */
class RmaManager
{
    /**
     * @var RmaFactory
     */
    protected $rmaFactory;

    /**
     * @var StatusFactory
     */
    protected $statusFactory;

    /**
     * @var \WebPanda\Rma\Model\MessageFactory
     */
    protected $messageFactory;

    /**
     * @var \WebPanda\Rma\Model\AttachmentFactory
     */
    protected $attachmentFactory;

    /**
     * @var Session
     */
    protected $authSession;

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * @var DataHelper
     */
    protected $dataHelper;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var TimezoneInterface
     */
    protected $localeDate;

    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * RmaManager constructor.
     * @param RmaFactory $rmaFactory
     * @param StatusFactory $statusFactory
     * @param \WebPanda\Rma\Model\MessageFactory $messageFactory
     * @param \WebPanda\Rma\Model\AttachmentFactory $attachmentFactory
     * @param Session $authSession
     * @param ConfigHelper $configHelper
     * @param DataHelper $dataHelper
     * @param StoreManagerInterface $storeManager
     * @param TransportBuilder $transportBuilder
     * @param TimezoneInterface $localeDate
     * @param OrderFactory $orderFactory
     * @param CustomerSession $customerSession
     */
    public function __construct(
        RmaFactory $rmaFactory,
        StatusFactory $statusFactory,
        RmaMessageFactory $messageFactory,
        AttachmentFactory $attachmentFactory,
        Session $authSession,
        ConfigHelper $configHelper,
        DataHelper $dataHelper,
        StoreManagerInterface $storeManager,
        TransportBuilder $transportBuilder,
        TimezoneInterface $localeDate,
        OrderFactory $orderFactory,
        CustomerSession $customerSession
    ) {
        $this->rmaFactory = $rmaFactory;
        $this->statusFactory = $statusFactory;
        $this->messageFactory = $messageFactory;
        $this->attachmentFactory = $attachmentFactory;
        $this->authSession = $authSession;
        $this->configHelper = $configHelper;
        $this->dataHelper = $dataHelper;
        $this->storeManager = $storeManager;
        $this->transportBuilder = $transportBuilder;
        $this->localeDate = $localeDate;
        $this->orderFactory = $orderFactory;
        $this->customerSession = $customerSession;
    }

    /**
     * @param $templateData
     * @return null|Rma
     * @throws LocalizedException
     */
    public function getRmaModel($templateData)
    {
        $model = null;
        if (is_numeric($templateData)) {
            $model = $this->rmaFactory->create()->load($templateData);
        } elseif ($templateData instanceof Rma) {
            $model = $templateData;
        }

        if (!$model || !$model->getId()) {
            throw new LocalizedException(__('Rma does not exist'));
        }
        
        return $model;
    }

    /**
     * @param array $data
     * @param bool $isGuest
     * @return \WebPanda\Rma\Model\Rma
     */
    public function createRma($data, $isGuest = false)
    {
        $data = $this->prepareRmaData($data, $isGuest);
        $rma = $this->rmaFactory->create()
            ->setData($data)
            ->setStatusId(StatusSource::PENDING_APPROVAL)
            ->save();

        $this->notifyStatusChangeToAdmin($rma);

        return $rma;
    }

    /**
     * @param array $data
     * @param boolean $isGuest
     * @return array
     * @throws LocalizedException
     */
    protected function prepareRmaData($data, $isGuest)
    {
        if (!isset($data['order_id'])) {
            throw new LocalizedException(__('Wrong form data.'));
        }
        if (!isset($data['items']) || count($data['items']) == 0) {
            throw new LocalizedException(__('Wrong form data.'));
        }
        if (!isset($data['items'])) {
            throw new LocalizedException(__('You need to select item/items to return.'));
        }

        $order = $this->orderFactory->create()->load($data['order_id']);
        if (!$order->getId() ) {
            throw new LocalizedException(__('Order does not exist.'));
        }
        if ($isGuest) {
            if ($order->getCustomerEmail() != $data['customer_email']) {
                throw new LocalizedException(__('Order does not exist.'));
            }
        } else {
            if ($order->getCustomerId() != $this->customerSession->getCustomerId()) {
                throw new LocalizedException(__('Order does not exist.'));
            }
        }
        if (!$this->dataHelper->isAllowedForOrder($order)) {
            throw new LocalizedException(__('You can\'t request a return for the given order.'));
        }
        $openItemsQty = $this->dataHelper->getOpenItemsQty($order->getId());
        $data = $this->prepareItems($data);
        foreach ($order->getItemsCollection() as $orderItem) {
            $availableQty = (float)isset($openItemsQty[$orderItem->getId()]) ?
                $orderItem->getQtyInvoiced() - $openItemsQty[$orderItem->getId()] :
                $orderItem->getQtyInvoiced();

            if (array_key_exists($orderItem->getId(), $data['items'])) {
                if (isset($data['items'][$orderItem->getId()]['qty'])) {
                    $requestQty = (float)$data['items'][$orderItem->getId()]['qty'];
                    if ($requestQty <= 0 || $this->compareFloatNumbers($requestQty, $availableQty, '>')) {
                        throw new LocalizedException(__('Wrong quantity for %1.', $orderItem->getName()));
                    }
                } else {
                    throw new LocalizedException(__('Wrong quantity for %1.', $orderItem->getName()));
                }
            }
        }

        $data['packing_slip'] = json_decode($data['packing_slip']);
        $data['store_id'] = $order->getStoreId();
        if ($isGuest) {
            $billingAddress = $order->getBillingAddress();
            $data['customer_email'] = $order->getCustomerEmail();
            $data['customer_name'] = $billingAddress->getFirstname() . ' ' . $billingAddress->getLastname();
        } else {
            $customerData = $this->customerSession->getCustomerData();
            $data['customer_id'] = $this->customerSession->getCustomerId();
            $data['customer_email'] = $customerData->getEmail();
            $data['customer_name'] = $customerData->getFirstname() . ' ' . $customerData->getLastname();
        }

        return $data;
    }

    protected function prepareItems($data)
    {
        foreach ($data['items'] as $key => $item) {
            if (!isset($item['active']) || !$item['active']) {
                unset($data['items'][$key]);
            }
        }

        return $data;
    }

    /**
     * @param $rma
     */
    public function notifyStatusChangeToCustomer($rma)
    {
        $statusObj = $this->statusFactory->create()
            ->setStoreId($rma->getStoreId())
            ->load($rma->getStatusId());

        if ($statusObj->getIsEmailCustomer()) {
            // make sure to set the status frontend label from the latest status
            $rma->setStatusFrontendLabel($statusObj->getAttribute('frontend_label'));
            $this->sendEmail($rma, 'customer', [], $statusObj->getAttribute('email_to_customer'));
        }

        if ($statusObj->getIsMessage()) {
            $admin = $this->authSession->getUser();
            $this->addMessage(
                [
                    'rma_id' => $rma->getId(),
                    'text' => $statusObj->getAttribute('message'),
                    'owner_type' => 1,
                    'owner_id' => $admin->getId(),
                    'is_auto' => true
                ]
            );
        }
    }

    /**
     * @param $rma
     */
    public function notifyStatusChangeToAdmin($rma)
    {
        $statusObj = $this->statusFactory->create()
            ->setStoreId($rma->getStoreId())
            ->load($rma->getStatusId());

        if ($statusObj->getIsEmailAdmin()) {
            // make sure to set the status frontend label from the latest status
            $rma->setStatusFrontendLabel($statusObj->getAttribute('frontend_label'));
            $this->sendEmail($rma, 'admin', [], $statusObj->getAttribute('email_to_admin'));
        }

        if ($statusObj->getIsMessage()) {
            $this->addMessage(
                [
                    'rma_id' => $rma->getId(),
                    'text' => $statusObj->getAttribute('message'),
                    'owner_type' => 2,
                    'owner_id' => $rma->getCustomerId(),
                    'is_auto' => true
                ]
            );
        }
    }

    /**
     * @param $rma
     * @param $text
     * @param array $uploadedFileNames
     * @param bool $sendMail
     */
    public function addAdminReply($rma, $text, $uploadedFileNames = [], $sendMail = false)
    {
        $admin = $this->authSession->getUser();
        $message = $this->addMessage(
            [
                'rma_id' => $rma->getId(),
                'text' => $text,
                'owner_type' => 1,
                'owner_id' => $admin->getId(),
                'is_auto' => false
            ]
        );

        if (!empty($uploadedFileNames)) {
            foreach ($uploadedFileNames as $name) {
                $attachment = $this->attachmentFactory->create()
                    ->setMessageId($message->getId())
                    ->setName($name)
                    ->save();
            }
        }

        if ($sendMail) {
            $this->sendReplyEmailToCustomer($rma, $text);
        }
    }

    /**
     * @param $rma
     * @param $text
     * @param array $uploadedFileNames
     * @param bool $sendMail
     */
    public function addCustomerReply($rma, $text, $uploadedFileNames = [], $sendMail = false)
    {
        $message = $this->addMessage(
            [
                'rma_id' => $rma->getId(),
                'text' => $text,
                'owner_type' => 2,
                'owner_id' => $rma->getCustomerId(),
                'is_auto' => false
            ]
        );

        if (!empty($uploadedFileNames)) {
            foreach ($uploadedFileNames as $name) {
                $attachment = $this->attachmentFactory->create()
                    ->setMessageId($message->getId())
                    ->setName($name)
                    ->save();
            }
        }

        if ($sendMail) {
            $this->sendReplyEmailToAdmin($rma, $text);
        }
    }

    /**
     * @param \WebPanda\Rma\Model\Rma $rma
     * @param string $text
     */
    public function sendReplyEmailToCustomer($rma, $text)
    {
        $templateData = ['comment' => $text];
        $this->sendEmail($rma, 'customer', $templateData);
    }

    /**
     * @param \WebPanda\Rma\Model\Rma $rma
     * @param string $text
     */
    public function sendReplyEmailToAdmin($rma, $text)
    {
        $templateData = ['comment' => $text];
        $this->sendEmail($rma, 'admin', $templateData);
    }

    /**
     * @param array $templateData
     */
    protected function addMessage($templateData)
    {
        return $this->messageFactory->create()
            ->setData($templateData)
            ->save()
        ;
    }

    /**
     * @param $rma
     * @param $receiver
     * @param array $templateData
     * @param null $templateId
     */
    private function sendEmail($rma, $receiver, $templateData = [], $templateId = null)
    {
        $emailConfigData = $this->configHelper->getEmailConfigData($rma->getStoreId());

        if ($receiver == 'admin') {
            $emailsEnabled = $this->configHelper->getNotifyAdmin($rma->getStoreId());
            if (!$emailsEnabled) {
                return;
            }
            $toEmail = $emailConfigData['department']['email'];
            $toName = $emailConfigData['department']['name'];
            if (!$templateId) {
                $templateId = $emailConfigData['template']['to_admin'];
            }
        } else {
            $emailsEnabled = $this->configHelper->getNotifyCustomer($rma->getStoreId());
            if (!$emailsEnabled) {
                return;
            }
            $toEmail = $rma->getFinalCustomerEmail();
            $toName = $rma->getCustomerName();
            if (!$templateId) {
                $templateId = $emailConfigData['template']['to_customer'];
            }
        }
        $templateData['template_id'] = $templateId;
        $templateData['rma'] = $rma;
        $templateVars = $this->prepareTemplateVars($templateData);

        $this->transportBuilder
            ->setTemplateIdentifier($templateId)
            ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $rma->getStoreId()])
            ->setTemplateVars($templateVars)
            ->setFrom($emailConfigData['department'])
            ->addTo($toEmail, $toName)
            ->getTransport()
            ->sendMessage();
    }

    /**
     * @param $templateData
     * @return array
     */
    protected function prepareTemplateVars($templateData)
    {
        $templateVars = [];
        $rma = $templateData['rma'];

        $storeId = $rma->getStoreId();
        $rmaData = [
            'rma_id' => $rma->getIncrementId(),
            'status' => $rma->getStatusFrontendLabel() ?
                $rma->getStatusFrontendLabel() :
                $rma->getStatusName(),
            'created_at' => $this->formatDate($rma->getCreatedAt()),
            'updated_at' => $this->formatDate($rma->getUpdatedAt()),
            'customer_name' => $rma->getFinalCustomerName(),
            'customer_email' => $rma->getFinalCustomerEmail(),
            'items' => $rma->getItemsCollection(true)->toArray(),
            'url' => $this->dataHelper->getRmaUrl($rma),
            'admin_url' => $this->dataHelper->getAdminRmaUrl($rma),
            'order_id' => $rma->getOrder()->getIncrementId(),
            'order_url' => $this->dataHelper->getOrderUrl($rma->getOrder()),
            'order_admin_url' => $this->dataHelper->getAdminOrderUrl($rma->getOrder()),
            'store_name' => $this->storeManager->getStore($storeId)->getName(),
            'rma_department_address' => $this->configHelper->getRmaDepartmentAddress($rma->getStoreId())
        ];
        if (isset($templateData['comment'])) {
            $rmaData['comment_text'] = $templateData['comment'];
        }
        $varsObject = new \Magento\Framework\DataObject($rmaData);
        $templateVars = $varsObject->getData();

        return $templateVars;
    }

    /**
     * @param null $date
     * @return string
     */
    protected function formatDate($date = null)
    {
        $date = $date instanceof \DateTimeInterface ? $date : new \DateTime($date);
        return $this->localeDate->formatDateTime($this->localeDate->date($date), \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE);
    }

    /**
     * @param $rmaId
     * @param $data
     */
    public function savePackingSlip($rmaId, $data)
    {
        $rma = $this->getRmaModel($rmaId);

        $data['street'] = implode('\n', $data['street']);
        $currentPackingSlip = $rma->getPackingSlip();
        foreach ($data as $key => $value) {
            $currentPackingSlip[$key] = $value;
        }

        $rma->setPackingSlip($currentPackingSlip)
            ->save()
        ;
    }

    public function compareFloatNumbers($float1, $float2, $operator='=')
    {
        // Check numbers to 5 digits of precision
        $epsilon = 0.00001;

        $float1 = (float)$float1;
        $float2 = (float)$float2;

        switch ($operator)
        {
            // equal
            case "=":
            case "eq":
            {
                if (abs($float1 - $float2) < $epsilon) {
                    return true;
                }
                break;
            }
            // less than
            case "<":
            case "lt":
            {
                if (abs($float1 - $float2) < $epsilon) {
                    return false;
                }
                else
                {
                    if ($float1 < $float2) {
                        return true;
                    }
                }
                break;
            }
            // less than or equal
            case "<=":
            case "lte":
            {
                if (compareFloatNumbers($float1, $float2, '<') || compareFloatNumbers($float1, $float2, '=')) {
                    return true;
                }
                break;
            }
            // greater than
            case ">":
            case "gt":
            {
                if (abs($float1 - $float2) < $epsilon) {
                    return false;
                }
                else
                {
                    if ($float1 > $float2) {
                        return true;
                    }
                }
                break;
            }
            // greater than or equal
            case ">=":
            case "gte":
            {
                if (compareFloatNumbers($float1, $float2, '>') || compareFloatNumbers($float1, $float2, '=')) {
                    return true;
                }
                break;
            }
            case "<>":
            case "!=":
            case "ne":
            {
                if (abs($float1 - $float2) > $epsilon) {
                    return true;
                }
                break;
            }
            default:
            {
                return false;
            }
        }

        return false;
    }
}
