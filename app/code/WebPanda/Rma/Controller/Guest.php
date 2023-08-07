<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
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

/**
 * Class Guest
 * @package WebPanda\Rma\Controller
 */
abstract class Guest extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var Validator
     */
    protected $formKeyValidator;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var RmaManager
     */
    protected $rmaManager;

    /**
     * @var RmaItemFactory
     */
    protected $itemFactory;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var UploaderFactory
     */
    protected $fileUploader;

    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * @var FileFactory
     */
    protected $fileFactory;

    /**
     * @var printPackingSlip
     */
    protected $printPackingSlip;

    /**
     * @var UrlInterface
     */
    protected $url;

    /**
     * Guest constructor.
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
        UrlInterface $url
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        $this->scopeConfig = $scopeConfig;
        $this->formKeyValidator = $formKeyValidator;
        $this->rmaManager = $rmaManager;
        $this->itemFactory = $itemFactory;
        $this->filesystem = $filesystem;
        $this->fileUploader = $fileUploader;
        $this->configHelper = $configHelper;
        $this->fileFactory = $fileFactory;
        $this->printPackingSlip = $printPackingSlip;
        $this->url = $url;
    }

    /**
     * @return bool
     */
    protected function validateFormKey()
    {
        return $this->formKeyValidator->validate($this->getRequest());
    }

    /**
     * @param RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        if (!$this->configHelper->getGuest()) {
            $this->_actionFlag->set('', 'no-dispatch', true);
        }
        return parent::dispatch($request);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    protected function goBack()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());

        return $resultRedirect;
    }
}