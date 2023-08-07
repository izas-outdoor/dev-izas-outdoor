<?php
/**
 * LandOfCoder
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Venustheme.com license that is
 * available through the world-wide-web at this URL:
 * http://www.venustheme.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   LandOfCoder
 * @package    Lof_Rma
 * @copyright  Copyright (c) 2016 Venustheme (http://www.LandOfCoder.com/)
 * @license    http://www.LandOfCoder.com/LICENSE-1.0.html
 */



namespace Lof\Rma\Api\Data;

use Lof\Rma\Api;

/**
 * @method Api\Data\RmaSearchResultsInterface getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
 */
interface OrderStatusHistoryInterface extends DataInterface
{
    const KEY_HISTORY_ID = 'history_id';
    const KEY_ORDER_ID   = 'order_id';
    const KEY_STATUS     = 'status';
    const KEY_CREATED_AT = 'created_at';

    /**
     * @return int
     */
    public function getHistoryId();

    /**
     * @param int $historyId
     * @return $this
     */
    public function setHistoryId($historyId);

    /**
     * @return int
     */
    public function getOrderId();

    /**
     * @param int $orderId
     * @return $this
     */
    public function setOrderId($orderId);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $date
     * @return $this
     */
    public function setCreatedAt($date);
}