<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model;

/**
 * Class Status
 * @package WebPanda\Rma\Model
 */
class Status extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var int|null
     */
    protected $storeId = null;

    protected function _construct()
    {
        $this->_init('WebPanda\Rma\Model\ResourceModel\Status');
    }

    /**
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
        return $this;
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->storeId;
    }
}
