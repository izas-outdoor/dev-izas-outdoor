<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Message
 * @package WebPanda\Rma\Model\ResourceModel
 */
class Message extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('wp_rma_message', 'id');
    }
}
