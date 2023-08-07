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


namespace Lof\Rma\Controller\Rma;
use Magento\Framework\Controller\ResultFactory;

class Order extends \Lof\Rma\Controller\Rma
{
    public function __construct(
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Action\Context $context
    ) {
        $this->orderFactory = $orderFactory;
        $this->registry     = $registry;
        $this->customerSession = $customerSession;

        parent::__construct($customerSession, $context);
    }

    /**
     * Shows RMAs in order page frontend
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        if ($orderId = $this->getRequest()->getParam('order_id')) {
            $order = $this->orderFactory->create()->load($orderId);
            $customer = $this->customerSession->getCustomer();
            if ($order->getCustomerId() == $customer->getId()) {
                $this->registry->register('current_order', $order);
                if ($navigationBlock = $resultPage->getLayout()->getBlock('customer_account_navigation')) {
                    $navigationBlock->setActive('sales/order/history');
                }
                return $resultPage;
            }
        }
    }
}