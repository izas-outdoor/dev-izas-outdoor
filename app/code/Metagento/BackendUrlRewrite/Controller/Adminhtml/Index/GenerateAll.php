<?php
/**
 * Created by Metagento.com
 * Date: 4/18/2019
 */

namespace Metagento\BackendUrlRewrite\Controller\Adminhtml\Index;


class GenerateAll extends \Magento\Backend\App\Action
{

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Metagento\BackendUrlRewrite\Service\ProductProcess $productProcess,
        \Metagento\BackendUrlRewrite\Service\CategoryProcess $categoryProcess
    ) {
        parent::__construct($context);
        $this->productProcess  = $productProcess;
        $this->categoryProcess = $categoryProcess;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $this->productProcess->generateProducts([], []);
            $this->categoryProcess->generateCategories([], []);
            $this->messageManager->addSuccessMessage(__("URL Rewrites have been generated"));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $result->setUrl($this->_redirect->getRefererUrl());
        return $result;
    }
}