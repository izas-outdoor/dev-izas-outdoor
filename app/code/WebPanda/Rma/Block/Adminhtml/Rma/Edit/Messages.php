<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit;

use Magento\Backend\Block\Template\Context;
use WebPanda\Rma\Model\RmaFactory;
use WebPanda\Rma\Model\ResourceModel\Message\CollectionFactory as MessageCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Messages
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit
 */
class Messages extends \Magento\Backend\Block\Template
{
    protected $_template = 'rma/edit/messages.phtml';

    /**
     * @var RmaFactory
     */
    protected $rmaFactory;

    /**
     * @var MessageCollectionFactory
     */
    protected $messageCollectionFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    protected $rma;

    protected $collection;

    /**
     * Messages constructor.
     * @param Context $context
     * @param RmaFactory $rmaFactory
     * @param MessageCollectionFactory $messageCollectionFactory
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        RmaFactory $rmaFactory,
        MessageCollectionFactory $messageCollectionFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->rmaFactory = $rmaFactory;
        $this->messageCollectionFactory = $messageCollectionFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @return string
     */
    public function getSubmitUrl()
    {
        return $this->getUrl('rma_admin/rma/reply');
    }

    /**
     * Retrieve current RMA instance
     *
     * @return \WebPanda\Rma\Model\Rma
     */
    public function getRma()
    {
        if ($this->rma == null) {
            $rmaId = (int)$this->getRequest()->getParam('id', false);
            $this->rma = $this->rmaFactory->create()->load($rmaId);
        }

        return $this->rma;
    }

    /**
     * @return \WebPanda\Rma\Model\ResourceModel\Message\Collection
     */
    public function getMessageCollection()
    {
        if ($this->collection == null) {
            $this->collection = $this->messageCollectionFactory->create()
                ->addFieldToFilter('rma_id', $this->getRma()->getId())
                ->setOrder('created_at')
                ->load()
                ;
        }

        return $this->collection;
    }

    /**
     * @param $message
     * @return string
     */
    public function getMessageHeader($message)
    {
        if ($message->getIsAuto()) {
            $segment1 = __("Automatic Message");
            $segment2 = $message->isAdmin() ? __("Administrator") : __("Customer");
            if ($message->isAdmin()) {
                $segment2 .= ', ' . $message->getOwnerName();
            }
        } else {
            $segment1 = $message->getOwnerName();
            $segment2 =  $message->isAdmin() ? __("Administrator") : __("Customer");
        }
        $dateCreated = $this->formatDate($this->_localeDate->date(new \DateTime($message->getCreatedAt())), \IntlDateFormatter::MEDIUM, true);

        return "{$segment1} ({$segment2}), {$dateCreated}";
    }

    /**
     * Retrieve attachment url
     * @param string $fileName
     * @return string
     */
    public function getAttachmentUrl($fileName)
    {
        return $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) .
            \WebPanda\Rma\Model\Attachment::TEMP_PATH . DIRECTORY_SEPARATOR .
            $fileName;
    }
}
