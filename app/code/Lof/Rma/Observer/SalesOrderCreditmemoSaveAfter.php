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



namespace Lof\Rma\Observer;

use Magento\Framework\Event\ObserverInterface;

class SalesOrderCreditmemoSaveAfter implements ObserverInterface
{
    public function __construct(
        \Lof\Rma\Model\RmaFactory $rmaFactory,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Backend\Model\Session $backendSession
    ) {
        $this->rmaFactory = $rmaFactory;
        $this->_resource      = $resource;
        $this->backendSession = $backendSession;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $creditmemo = $observer->getDataObject();
        $session = $this->backendSession;
        if ($rmaId = $session->getRmaId()) {
            $id = $creditmemo->getId();
            
            $objArray = [
                'rc_rma_id' => $rmaId,
                'rc_credit_memo_id' => $id,
            ];
            $this->_resource->getConnection()->insert(
                 $this->_resource->getTableName('lof_rma_rma_creditmemo'),
                $objArray
            );
            $session->unsetRmaId();
        }
    }
}
