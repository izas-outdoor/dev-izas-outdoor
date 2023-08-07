<?php
namespace Izas\Sales\Ui\Component\Listing\Column\Order;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Izas\Sales\Helper\Data as HelperData;

/**
 * Class Items
 * @package Izas\Sales\Ui\Component\Listing\Column\Order
 */
class Items extends Column
{
    /**
     * @var HelperData
     */
    protected $helper;

    /**
     * Items constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param HelperData $helper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        HelperData $helper,
        array $components = [],
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                $products[] = $this->helper->getProductsColumnData($items['entity_id']);
                $items['products'] = implode(' , ', $products);
                unset($products);
            }
        }
        return $dataSource;
    }
}