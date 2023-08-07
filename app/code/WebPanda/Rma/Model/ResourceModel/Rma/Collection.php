<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\ResourceModel\Rma;

/**
 * Class Collection
 * @package WebPanda\Rma\Model\ResourceModel\Rma
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Current scope (store Id)
     *
     * @var int
     */
    protected $storeId;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Collection constructor.
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\DB\Adapter\AdapterInterface|null $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb|null $resource
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        $this->storeManager = $storeManager;
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $connection,
            $resource
        );
    }

    protected function _construct()
    {
        $this->_init('WebPanda\Rma\Model\Rma', 'WebPanda\Rma\Model\ResourceModel\Rma');
    }

    /**
     * @return $this
     */
    public function joinStatus()
    {
        $this->getSelect()
            ->joinLeft(
                ['rma_status' => $this->getTable('wp_rma_status')],
                "main_table.status_id = rma_status.id",
                [
                    'status_entity_color' => 'rma_status.color',
                    'status_entity_name' => 'rma_status.name'
                ]
            );

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function joinStatusAttribute($attributes)
    {
        foreach ($attributes as $attrCode) {
            $this->getSelect()
                ->joinLeft(
                    [$attrCode => $this->getTable('wp_rma_status_attribute')],
                    "main_table.status_id = {$attrCode}.status_id AND main_table.store_id = {$attrCode}.store_id AND " .
                    $this->getConnection()->quoteInto("code = ?", $attrCode),
                    [
                        'status_' . $attrCode => $attrCode.'.value'
                    ]
                );
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function joinOrders()
    {
        $this->getSelect()
            ->joinLeft(
                ['sales_order' => $this->getTable('sales_order')],
                'main_table.order_id = sales_order.entity_id',
                [
                    'order_increment_id' => 'sales_order.increment_id'
                ]
            );

        return $this;
    }

    /**
     * @param $customerId
     * @return $this
     */
    public function addCustomerFilter($customerId)
    {
        return $this->addFieldToFilter('main_table.customer_id', $customerId);
    }

    /**
     * @param $orderId
     * @return $this
     */
    public function addOrderFilter($orderId)
    {
        return $this->addFieldToFilter('main_table.order_id', $orderId);
    }

    /**
     * Add store availability filter. Include availability product for store website.
     *
     * @param null|string|bool|int|Store $store
     * @return $this
     */
    public function addStoreFilter($store = null)
    {
        if ($store === null) {
            $store = $this->getStoreId();
        }
        $store = $this->storeManager->getStore($store);

        if ($store->getId() != \Magento\Store\Model\Store::DEFAULT_STORE_ID) {
            $this->addFieldToFilter('main_table.store_id', $store->getId());
        }

        return $this;
    }

    /**
     * Set store scope
     *
     * @param int|string|\Magento\Store\Api\Data\StoreInterface $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        if ($storeId instanceof \Magento\Store\Api\Data\StoreInterface) {
            $storeId = $storeId->getId();
        }
        $this->storeId = (int)$storeId;
        return $this;
    }

    /**
     * Return current store id
     *
     * @return int
     */
    public function getStoreId()
    {
        if ($this->storeId === null) {
            $this->setStoreId($this->storeManager->getStore()->getId());
        }
        return $this->storeId;
    }
}
