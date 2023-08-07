<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;
use Magento\Backend\Block\Widget\Grid\Column;
use Magento\Backend\Block\Widget\Grid\Extended;

/**
 * Class Grid
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry = null;

    /**
     * @var \WebPanda\Rma\Model\RmaFactory
     */
    protected $rmaFactory;

    protected $rma;

    /**
     * Grid constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \WebPanda\Rma\Model\RmaFactory $rmaFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Framework\Registry $coreRegistry,
        \WebPanda\Rma\Model\RmaFactory $rmaFactory,
        array $data = []
    ) {
        parent::__construct($context, $backendHelper, $data);
        $this->registry = $coreRegistry;
        $this->rmaFactory = $rmaFactory;
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('rma_items');
        $this->setDefaultSort('id');
        $this->setFilterVisibility(false);
        $this->setUseAjax(true);
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
     * @return Grid
     */
    protected function _prepareCollection()
    {
        $collection = $this->getRma()->getItemsCollection();
        $storeId = (int)$this->getRequest()->getParam('store', 0);
        if ($storeId > 0) {
            $collection->addFieldToFilter('store_id', $storeId);
        }
        $this->setCollection($collection);

        $itemIds = $this->_getSelectedItems();
        if (empty($itemIds)) {
            $itemIds = 0;
        }
        $isAjax = $this->getRequest()->getParam('ajax');

        // only add filter by already assigned items on page load, not on filters
        if ($this->getRma() && $this->getRma()->getId() && !$isAjax) {
            $this->getCollection()->addFieldToFilter('id', ['in' => $itemIds]);
        }

        return parent::_prepareCollection();
    }

    /**
     * @return Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'product_id',
            [
                'header' => __('Product Name'),
                'sortable' => false,
                'index' => 'product_id',
                'header_css_class' => 'col-product-name',
                'column_css_class' => 'col-product-name',
                'renderer' => \WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products\Grid\Renderer\ProductName::class
            ]
        );
        $this->addColumn(
            'sku',
            [
                'header' => __('SKU'),
                'sortable' => false,
                'index' => 'sku',
                'header_css_class' => 'col-sku',
                'column_css_class' => 'col-sku'
            ]
        );
        $this->addColumn(
            'qty',
            [
                'header' => __('Qty to Return'),
                'sortable' => false,
                'index' => 'qty',
                'header_css_class' => 'col-qty',
                'column_css_class' => 'col-qty'
            ]
        );
        $this->addColumn(
            'reason',
            [
                'header' => __('Reason'),
                'sortable' => false,
                'index' => 'reason',
                'header_css_class' => 'col-reason',
                'column_css_class' => 'col-reason',
                'renderer' => \WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products\Grid\Renderer\Reason::class
            ]
        );
        $this->addColumn(
            'item_condition',
            [
                'header' => __('Item Condition'),
                'sortable' => false,
                'index' => 'item_condition',
                'header_css_class' => 'col-reason',
                'column_css_class' => 'col-reason',
                'renderer' => \WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products\Grid\Renderer\ItemCondition::class
            ]
        );
        $this->addColumn(
            'resolution',
            [
                'header' => __('Resolution'),
                'sortable' => false,
                'index' => 'resolution',
                'header_css_class' => 'col-reason',
                'column_css_class' => 'col-reason',
                'renderer' => \WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Products\Grid\Renderer\Resolution::class
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('rma_admin/rma/grid', ['_current' => true]);
    }

    /**
     * @return array
     */
    protected function _getSelectedItems()
    {
        $items = $this->getRequest()->getPost('selected_items');
        if ($items === null) {
            $rma = $this->getRma();
            if ($rma) {
                $items = $rma->getItemsCollection()->getItems();
                if (!empty($items)) {
                    $arr = [];
                    foreach ($items as $item) {
                        $arr[] = $item->getId();
                    }
                    return $arr;
                }
                return [];
            }
        }
        
        return $items;
    }
}
