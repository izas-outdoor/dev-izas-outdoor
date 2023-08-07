<?php


namespace Metagento\Faq\Controller\Adminhtml\Category;


class Grid extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{

    /**
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $resultLayout = $this->_resultLayoutFactory->create();
        return $resultLayout;
    }
}
