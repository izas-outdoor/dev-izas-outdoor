<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use WebPanda\Rma\Helper\Config;
use WebPanda\Rma\Model\ItemFactory;

/**
 * Class Rma
 * @package WebPanda\Rma\Model\ResourceModel
 */
class Rma extends AbstractDb
{
    /**
     * @var array
     */
    protected $_serializableFields = [
        'packing_slip' => [[], []]
    ];

    /**
     * @var Config
     */
    protected $configHelper;

    /**
     * @var \WebPanda\Rma\Model\ResourceModel\ItemFactory
     */
    protected $itemFactory;

    /**
     * Rma constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param Config $configHelper
     * @param ItemFactory $itemFactory
     * @param null $connectionName
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        Config $configHelper,
        ItemFactory $itemFactory,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->configHelper = $configHelper;
        $this->itemFactory = $itemFactory;
    }

    /**
     * Define main table
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('wp_rma', 'id');
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return \Magento\Framework\DB\Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $mainTable = $this->getMainTable();
        $select = parent::_getLoadSelect($field, $value, $object);
        $select
            ->joinLeft(
                ['frontend_label_table' => $this->getTable('wp_rma_status_attribute')],
                "{$mainTable}.status_id = frontend_label_table.status_id AND {$mainTable}.store_id = frontend_label_table.store_id AND frontend_label_table.code = 'frontend_label'",
                [
                    'status_frontend_label' => 'frontend_label_table.value'
                ]
            );

        return $select;
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        return parent::_beforeSave($object);
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $this->saveRmaItems($object);
        return parent::_afterSave($object);
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    private function saveRmaItems(\Magento\Framework\Model\AbstractModel $object)
    {
        $items = $object->getItems();
        if (!is_array($items)) {
            return $this;
        }

        if (count($object->getItemsCollection(true))) {
            foreach ($items as $itemId => $data) {
                $item = $this->itemFactory->create()->load($itemId);
                $data = array_replace($item->getData(), $data);
                $item->setData($data)->save();
            }
        } else {
            foreach ($items as $data) {
                $this->itemFactory->create()
                    ->addData($data)
                    ->setRmaId($object->getId())
                    ->save()
                ;
            }
        }

        return $this;
    }

    public function getRmasId($orderId) {

        $rmas = [];
        $connection = $this->getConnection();
        $columns = ['id' => 'id'];
        $select = $connection->select()
                ->from($this->getTable($this->getMainTable()), $columns)
                ->where("order_id = ?", $orderId)
        ;

        $result = $connection->fetchAll($select);

        return $result;
    }
}
