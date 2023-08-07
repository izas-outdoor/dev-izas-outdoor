<?php


namespace Metagento\Faq\Controller\Adminhtml\Category;


class Import extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{
    public function execute()
    {
        $this->_registry->register('is_import', true);
        return $this->_forward('edit');
    }

}