<?php


namespace Metagento\Faq\Block\Adminhtml\Faq;


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
        $this->setId('faqGrid');
        $this->setDefaultSort('faq_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_faqCollectionFactory->create();
        $this->setCollection($collection);
        parent::_prepareCollection();

        foreach ( $this->getCollection() as $item ) {
            $item->setData('category_ids', explode(',', $item->getData('category_ids')));
        }
        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'faq_id',
            array(
                'header'           => __('ID'),
                'type'             => 'number',
                'index'            => 'faq_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            )
        );
        $this->addColumn(
            'title',
            array(
                'header'           => __('Title'),
                'type'             => 'text',
                'index'            => 'title',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
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
            'category_ids',
            array(
                'header'                    => __('Category'),
                'index'                     => 'category_ids',
                'header_css_class'          => 'col-id',
                'column_css_class'          => 'col-id',
                'type'                      => 'options',
                'options'                   => $this->_categoryOption->toOptionArray(),
                'filter_condition_callback' => array($this, 'filterCallback'),
            )
        );
        $this->addColumn(
            'tag',
            array(
                'header'                    => __('Tag'),
                'index'                     => 'tag',
                'header_css_class'          => 'col-id',
                'column_css_class'          => 'col-id',
                'type'                      => 'text',
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
        $this->setMassactionIdField('faq_id');
        $this->getMassactionBlock()->setFormFieldName('faq');

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