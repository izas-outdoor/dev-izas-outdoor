<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\ResourceModel\Attachment;

/**
 * Class Collection
 * @package WebPanda\Rma\Model\ResourceModel\Attachment
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('WebPanda\Rma\Model\Attachment', 'WebPanda\Rma\Model\ResourceModel\Attachment');
    }
}
