<?php
namespace Izas\Sales\Plugin\Ui\Model\Export;

use Magento\Framework\Api\Search\DocumentInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;
use Izas\Sales\Helper\Data as HelperData;

/**
 * Class MetadataProvider
 * @package Izas\Sales\Plugin\Ui\Model\Export
 */
class MetadataProvider
{
    /**
     * @var HelperData
     */
    protected $helper;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var OrderCollectionFactory
     */
    protected $orderCollectionFactory;

    /**
     * MetadataProvider constructor.
     * @param HelperData $helperData
     * @param RequestInterface $request
     * @param OrderCollectionFactory $orderCollectionFactory
     */
    public function __construct(
        HelperData $helperData,
        RequestInterface $request,
        OrderCollectionFactory $orderCollectionFactory
    ) {
        $this->helper = $helperData;
        $this->request = $request;
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    /**
     * @param $incrementId
     * @return \Magento\Framework\DataObject
     */
    public function getOrderByIncrementId($incrementId)
    {
        return $this->orderCollectionFactory->create()
            ->addFieldToFilter('increment_id', $incrementId)
            ->getFirstItem();
    }

    /**
     * @param \Magento\Ui\Model\Export\MetadataProvider $subject
     * @param DocumentInterface $document
     * @param $fields
     * @param $options
     * @return mixed
     */
    public function beforeGetRowData(\Magento\Ui\Model\Export\MetadataProvider $subject, $document, $fields, $options)
    {
        if ($this->request->getParam('namespace') === 'sales_order_grid') {
            $orderId = $this->getOrderByIncrementId($document->getIncrementId())->getId();
            $document->setProducts($this->helper->getProductsColumnData($orderId));
        }

        return [$document, $fields, $options];
    }
}
