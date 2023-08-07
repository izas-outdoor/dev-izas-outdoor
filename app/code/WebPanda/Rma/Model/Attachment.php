<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Model;

/**
 * Class Attachment
 * @package WebPanda\Rma\Model
 */
class Attachment extends \Magento\Framework\Model\AbstractModel
{
    const TEMP_PATH = 'wp_rma/attachments';

    protected function _construct()
    {
        $this->_init('WebPanda\Rma\Model\ResourceModel\Attachment');
    }
}
