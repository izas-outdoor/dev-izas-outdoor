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


namespace Lof\Rma\Controller\Adminhtml\Address;

use Magento\Framework\Controller\ResultFactory;

class Add extends \Lof\Rma\Controller\Adminhtml\Address
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $this->_initAddress();

        $this->initPage($resultPage);
        $resultPage->getConfig()->getTitle()->prepend(__('New Return Address'));
        $this->_addBreadcrumb(
            __('Return Address Manager'),
            __('Return Address Manager'),
            $this->getUrl('*/*/')
        );
        $this->_addBreadcrumb(__('Add Return Address '), __('Add Return Address'));

        $resultPage->getLayout()
            ->getBlock('head')
            ;
        $this->_addContent($resultPage->getLayout()->createBlock('\Lof\Rma\Block\Adminhtml\Address\Edit'));

        return $resultPage;
    }
}
