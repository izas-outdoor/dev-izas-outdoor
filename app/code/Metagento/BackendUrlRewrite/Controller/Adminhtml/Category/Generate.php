<?php
/**
 * Created by Metagento.com
 * Date: 4/19/2019
 */

namespace Metagento\BackendUrlRewrite\Controller\Adminhtml\Category;


class Generate extends \Magento\Backend\App\Action
{
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Metagento\BackendUrlRewrite\Service\CategoryProcess $categoryProcess
    ) {
        parent::__construct($context);
        $this->categoryProcess = $categoryProcess;
    }

    public function execute()
    {
        $params   = $this->getRequest()->getParams();
        $storeIds = [];
        if (array_key_exists('storeId', $params)) {
            $storeIds[] = $params['storeId'];
        }
        try {
            $this->categoryProcess->generateCategories([$params['id']], $storeIds);
            $this->messageManager->addSuccessMessage(__("URL Rewrites have been generated"));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $result->setUrl($this->_redirect->getRefererUrl());
        return $result;
    }

}