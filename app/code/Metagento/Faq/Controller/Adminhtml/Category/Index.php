<?php


namespace Metagento\Faq\Controller\Adminhtml\Category;


class Index extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }

}