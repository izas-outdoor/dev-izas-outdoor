<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Ui\DataProvider;

use WebPanda\Rma\Model\ResourceModel\Rma\CollectionFactory;

/**
 * Class RmaDataProvider
 * @package WebPanda\Rma\Ui\DataProvider
 */
class RmaDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
     * RmaDataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()
                ->joinStatus()
                ->load();
            foreach ($this->getCollection() as $rma) {
                $rma->setData(
                    'products',
                    $rma->getItemsCollection()->toArray(['product_id', 'name', 'resolution', 'item_condition', 'reason'])
                );
            }
        }

        return parent::getData();
    }
}
