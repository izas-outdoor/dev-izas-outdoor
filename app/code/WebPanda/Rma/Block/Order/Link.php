<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Order;

/**
 * Class Link
 * @package WebPanda\Rma\Block\Order
 */
class Link extends \Magento\Sales\Block\Order\Link
{
    /**
     * @var \WebPanda\Rma\Model\ResourceModel\Rma\CollectionFactory
     */
    protected $rmaCollectionFactory;

    /**
     * Link constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\DefaultPathInterface $defaultPath
     * @param \Magento\Framework\Registry $registry
     * @param \WebPanda\Rma\Model\ResourceModel\Rma\CollectionFactory $rmaCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\DefaultPathInterface $defaultPath,
        \Magento\Framework\Registry $registry,
        \WebPanda\Rma\Model\ResourceModel\Rma\CollectionFactory $rmaCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $defaultPath, $registry, $data);
        $this->rmaCollectionFactory = $rmaCollectionFactory;
    }

    /**
     * Retrieve current order model instance
     *
     * @return \Magento\Sales\Model\Order
     */
    private function getOrder()
    {
        return $this->_registry->registry('current_order');
    }

    protected function hasRma()
    {
        $collection = $this->rmaCollectionFactory->create()
            ->addOrderFilter($this->getOrder()->getId())
            ->addStoreFilter()
        ;

        return ($collection->getSize() > 0);
    }

    /**
     * @inheritdoc
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->hasRma()) {
            return '';
        }

        return parent::_toHtml();
    }
}
