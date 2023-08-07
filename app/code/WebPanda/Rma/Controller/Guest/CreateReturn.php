<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Guest;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Registry;
use WebPanda\Rma\Model\RmaManager;
use WebPanda\Rma\Model\ItemFactory as RmaItemFactory;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use WebPanda\Rma\Helper\Config as ConfigHelper;
use Magento\Framework\App\Response\Http\FileFactory;
use WebPanda\Rma\Model\PrintPackingSlip;
use Magento\Framework\UrlInterface;
use WebPanda\Rma\Helper\Data as DataHelper;
use Magento\Sales\Model\OrderFactory;

/**
 * Class CreateRequest
 * @package WebPanda\Rma\Controller\Guest
 */
class CreateReturn extends \WebPanda\Rma\Controller\Guest
{
    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    private $orderFactory;

    /**
     * @var DataHelper
     */
    protected $dataHelper;

    /**
     * CreateReturn constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $coreRegistry
     * @param ScopeConfigInterface $scopeConfig
     * @param Validator $formKeyValidator
     * @param RmaManager $rmaManager
     * @param RmaItemFactory $itemFactory
     * @param Filesystem $filesystem
     * @param UploaderFactory $fileUploader
     * @param ConfigHelper $configHelper
     * @param FileFactory $fileFactory
     * @param PrintPackingSlip $printPackingSlip
     * @param UrlInterface $url
     * @param DataHelper $dataHelper
     * @param OrderFactory $orderFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        ScopeConfigInterface $scopeConfig,
        Validator $formKeyValidator,
        RmaManager $rmaManager,
        RmaItemFactory $itemFactory,
        Filesystem $filesystem,
        UploaderFactory $fileUploader,
        ConfigHelper $configHelper,
        FileFactory $fileFactory,
        PrintPackingSlip $printPackingSlip,
        UrlInterface $url,
        DataHelper $dataHelper,
        OrderFactory $orderFactory
    ) {
        parent::__construct(
            $context,
            $resultPageFactory,
            $coreRegistry,
            $scopeConfig,
            $formKeyValidator,
            $rmaManager,
            $itemFactory,
            $filesystem,
            $fileUploader,
            $configHelper,
            $fileFactory,
            $printPackingSlip,
            $url
        );
        $this->orderFactory = $orderFactory;
        $this->dataHelper = $dataHelper;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if (!$this->validateFormKey()) {
            return $this->goBack();
        }
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            try {
                if (!isset($data['order_increment_id'])) {
                    throw new LocalizedException(__('Order Number not specified.'));
                }
                if (!isset($data['email'])) {
                    throw new LocalizedException(__('Email not specified.'));
                }
                $orderIncrementId = trim($data['order_increment_id']);
                $orderIncrementId = preg_replace('/^#/', '', $orderIncrementId);
                /** @var \Magento\Sales\Model\Order $order */
                $order = $this->orderFactory->create()
                    ->loadByIncrementId($orderIncrementId)
                ;
                if (!$order->getId()) {
                    throw new LocalizedException(__('Order does not exists.'));
                }
                if (strcasecmp($order->getCustomerEmail(), $data['email'])) {
                    throw new LocalizedException(__('Order Number and Email didn\'t match.'));
                }
                if ($order->getCustomerId()) {
                    throw new LocalizedException(__('This order has been placed by registered customer. Please login to the customer account and try again.'));
                }
                if (!$this->dataHelper->isAllowedForOrder($order)) {
                    throw new LocalizedException(__('You can\'t request a return for the given order.'));
                }

                $data['order_id'] = $order->getId();
                $this->coreRegistry->register('rma_request', $data);

                $resultPage = $this->resultPageFactory->create();
                $resultPage->getConfig()->getTitle()->set(__('New Return for Order #%1', $orderIncrementId));
                return $resultPage;
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while creating the return.'));
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*');
    }
}
