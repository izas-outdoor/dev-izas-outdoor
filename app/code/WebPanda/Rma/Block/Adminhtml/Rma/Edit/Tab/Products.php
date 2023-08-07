<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab;

use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Class Products
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab
 */
class Products extends \Magento\Backend\Block\Template implements TabInterface
{
    /**
     * Block template
     *
     * @var string
     */
    protected $_template = 'rma/edit/assigned_items.phtml';

    /**
     * @var \WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products\Grid
     */
    protected $blockGrid;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;

    /**
     * @var \WebPanda\Rma\Model\RmaFactory
     */
    protected $rmaFactory;

    protected $rma;

    /**
     * AssignProducts constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \WebPanda\Rma\Model\RmaFactory $rmaFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->jsonEncoder = $jsonEncoder;
        $this->rmaFactory = $rmaFactory;
    }

    /**
     * Retrieve instance of grid block
     *
     * @return \Magento\Framework\View\Element\BlockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getBlockGrid()
    {
        if (null === $this->blockGrid) {
            $this->blockGrid = $this->getLayout()->createBlock(
                'WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products\Grid',
                'rma.product.grid'
            );
        }
        return $this->blockGrid;
    }

    /**
     * Return HTML of grid block
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getBlockGrid()->toHtml();
    }

    /**
     * @return string
     */
    public function getItemsJson()
    {
        $items = $this->getRma()->getItemsCollection()->getItems();
        if (!empty($items)) {
            $arr = [];
            foreach ($items as $item) {
                $arr[$item->getId()] = $item->getId();
            }
            return $this->jsonEncoder->encode($arr);
        }
        return '{}';
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
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Products');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Products');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
