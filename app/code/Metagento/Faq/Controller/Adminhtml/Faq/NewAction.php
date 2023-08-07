<?php


namespace Metagento\Faq\Controller\Adminhtml\Faq;


class NewAction extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{

    public function execute()
    {
        $this->_forward('edit');
    }

}