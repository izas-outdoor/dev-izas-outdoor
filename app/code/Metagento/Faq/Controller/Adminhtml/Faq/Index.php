<?php


namespace Metagento\Faq\Controller\Adminhtml\Faq;


class Index extends \Metagento\Faq\Controller\Adminhtml\AbstractController
{

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }

}