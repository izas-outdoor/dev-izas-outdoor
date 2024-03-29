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



namespace Lof\Rma\Controller\Adminhtml;

abstract class Field extends \Magento\Backend\App\Action
{
    public function __construct(
        \Lof\Rma\Model\FieldFactory $fieldFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->fieldFactory   = $fieldFactory;
        $this->localeDate     = $localeDate;
        $this->registry       = $registry;
        $this->context        = $context;
        $this->backendSession = $context->getSession();
        $this->resultFactory  = $context->getResultFactory();

        parent::__construct($context);
    }

    /**
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Lof_Rma::rma_rma');
        $resultPage->getConfig()->getTitle()->prepend(__('RMA Custom Field'));
        return $resultPage;
    }

    /**
     * {@inheritdoc}
     */
    public function _initField()
    {
        $field = $this->fieldFactory->create();
        if ($this->getRequest()->getParam('id')) {
            $field->load($this->getRequest()->getParam('id'));
            if ($storeId = (int) $this->getRequest()->getParam('store')) {
                $field->setStoreId($storeId);
            }
        }

        $this->registry->register('current_field', $field);

        return $field;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->context->getAuthorization()->isAllowed('Lof_Rma::rma_dictionary_field');
    }

    /************************/
}
