<?php


namespace Metagento\Faq\Block\Adminhtml\Category;


class Grid extends
    \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Metagento\Faq\Model\ResourceModel\Faq\CollectionFactory
     */
    protected $_faqCollectionFactory;
    /**
     * @var \Metagento\Faq\Model\ResourceModel\Category\CollectionFactory
     */
    protected $_categoryCollectionFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Metagento\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory
     * @param \Metagento\Faq\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Metagento\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory,
        \Metagento\Faq\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Metagento\Faq\Model\Option\Category $categoryOption,
        \Metagento\Faq\Model\Option\Status $statusOption,
        array $data = array()
    ) {
        $this->_faqCollectionFactory      = $faqCollectionFactory;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_categoryOption            = $categoryOption;
        $this->_statusOption              = $statusOption;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('faqCategoryGrid');
        $this->setDefaultSort('category_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_categoryCollectionFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return $this
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'category_id',
            array(
                'header'           => __('ID'),
                'type'             => 'number',
                'index'            => 'category_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            )
        );
        $this->addColumn(
            'name',
            array(
                'header'           => __('Category Name'),
                'type'             => 'text',
                'index'            => 'name',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            )
        );

        $this->addColumn(
            'store_id',
            array(
                'header'           => __('Stores'),
                'type'             => 'store',
                'index'            => 'store_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'store_view'       => true,
            )
        );

        $this->addColumn(
            'url_key',
            array(
                'header'           => __('Url Key'),
                'type'             => 'text',
                'index'            => 'url_key',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            )
        );
        $this->addColumn(
            'sort_order',
            array(
                'header'           => __('Sort Order'),
                'type'             => 'number',
                'index'            => 'sort_order',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            )
        );
        $this->addColumn(
            'status',
            array(
                'header'           => __('Status'),
                'index'            => 'status',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
                'type'             => 'options',
                'options'          => $this->_statusOption->toOptionArray(),
            )
        );
        $this->addColumn(
            'edit',
            [
                'header'           => __('Action'),
                'type'             => 'action',
                'getter'           => 'getId',
                'actions'          => [
                    [
                        'caption' => __('Edit'),
                        'url'     => ['base' => '*/*/edit'],
                        'field'   => 'id',
                    ],
                ],
                'filter'           => false,
                'sortable'         => false,
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
                'is_system'        => true,
            ]
        );

//        $this->addExportType('*/*/exportCsv', __('CSV'));
//        $this->addExportType('*/*/exportExcel', __('Excel XML'));
        return parent::_prepareColumns();
    }

    /**
     * @param $collection
     * @param $column
     */
    public function filterCallback(
        $collection,
        $column
    ) {
        $value = $column->getFilter()->getValue();
        if ( !is_null($value) ) {
            $collection->addFieldToFilter($column->getIndex(), array('finset' => $value));
        }
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    /**
     * @param \Magento\Catalog\Model\Product|\Magento\Framework\DataObject $row
     * @return string
     */
    public function getRowUrl( $row )
    {
        return $this->getUrl(
            '*/*/edit',
            array('id' => $row->getId())
        );
    }


    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('category_id');
        $this->getMassactionBlock()->setFormFieldName('category');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label'   => __('Delete'),
                'url'     => $this->getUrl('*/*/massDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );


        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label'      => __('Change status'),
                'url'        => $this->getUrl('*/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name'   => 'status',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => __('Status'),
                        'values' => array(
                            1 => 'Enabled',
                            2 => 'Disabled',
                        ),
                    ],
                ],
            ]
        );
        return $this;
    }
}