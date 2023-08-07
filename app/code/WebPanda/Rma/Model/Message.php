<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model;

use Magento\User\Model\UserFactory;
use Magento\Customer\Model\CustomerFactory;
use WebPanda\Rma\Model\ResourceModel\Attachment\CollectionFactory as AttachmentCollectionFactory;

/**
 * Class Message
 * @package WebPanda\Rma\Model
 */
class Message extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var UserFactory
     */
    protected $adminUserFactory;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var AttachmentCollectionFactory
     */
    protected $attachmentCollectionFactory;

    protected $owner;

    protected $attachments;

    /**
     * Message constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param UserFactory $userFactory
     * @param CustomerFactory $customerFactory
     * @param AttachmentCollectionFactory $attachmentCollectionFactory
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        UserFactory $userFactory,
        CustomerFactory $customerFactory,
        AttachmentCollectionFactory $attachmentCollectionFactory,
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
        $this->adminUserFactory = $userFactory;
        $this->customerFactory = $customerFactory;
        $this->attachmentCollectionFactory = $attachmentCollectionFactory;
    }

    protected function _construct()
    {
        $this->_init('WebPanda\Rma\Model\ResourceModel\Message');
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->getOwnerType() == 1;
    }

    /**
     * @return bool
     */
    public function isCustomer()
    {
        return $this->getOwnerType() == 2;
    }

    public function getOwner()
    {
        if ($this->owner == null) {
            if ($this->isAdmin()) {
                $this->owner = $this->adminUserFactory->create()->load($this->getOwnerId());
            } else {
                $this->owner = $this->customerFactory->create()->load($this->getOwnerId());
            }
        }

        return $this->owner;
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getOwnerName()
    {
        if ($this->getOwner()->getId()) {
            return $this->getOwner()->getName();
        } else {
            if ($this->isAdmin()) {
                return __('Deleted Admin');
            } else {
                return __('Guest Customer');
            }
        }
    }

    public function getAttachments()
    {
        if ($this->attachments == null) {
            $this->attachments = $this->attachmentCollectionFactory->create()
                ->addFieldToFilter('message_id', $this->getId())
                ->getItems()
            ;
        }

        return $this->attachments;
    }
}
