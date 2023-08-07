<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Controller\Adminhtml\Rma;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;
use WebPanda\Rma\Model\RmaFactory;
use Magento\Framework\Registry;

/**
 * Class Grid
 * @package WebPanda\Rma\Controller\Adminhtml\Rma
 */
class Grid extends \WebPanda\Rma\Controller\Adminhtml\Rma
{
    /**
     * @var RawFactory
     */
    protected $resultRawFactory;

    /**
     * @var LayoutFactory
     */
    protected $layoutFactory;

    /**
     * @var RmaFactory
     */
    protected $rmaFactory;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * Grid constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param RawFactory $resultRawFactory
     * @param LayoutFactory $layoutFactory
     * @param RmaFactory $rmaFactory
     * @param Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        RawFactory $resultRawFactory,
        LayoutFactory $layoutFactory,
        RmaFactory $rmaFactory,
        Registry $coreRegistry
    ) {
        parent::__construct($context, $resultPageFactory);
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
        $this->rmaFactory = $rmaFactory;
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $rma = $this->rmaFactory->create()->load($id);
        $this->coreRegistry->register('rma_request', $rma);

        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents(
            $this->layoutFactory->create()->createBlock(
                'WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products',
                'rma.product.grid.ajax'
            )->toHtml()
        );
    }
}
