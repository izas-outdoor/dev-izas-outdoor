<?php


namespace Metagento\Faq\Controller\Adminhtml\Faq;


class ImportProcess extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Metagento\Faq\Model\FaqFactory $faqFactory,
        \Metagento\Faq\Model\CategoryFactory $categoryFactory,
        \Metagento\Faq\Helper\Data $faqHelper,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\File\Csv $csv
    ) {
        $this->_csv       = $csv;
        $this->_faqHelper = $faqHelper;
        parent::__construct($context, $faqFactory, $categoryFactory, $pageFactory, $registry, $resultLayoutFactory);
    }

    public function execute()
    {
        if ( $this->getRequest()->isPost() && !empty($_FILES['file_csv']['tmp_name']) ) {
            $data = $this->_csv->getData($_FILES['file_csv']['tmp_name']);
            unset($data[0]);
            $count = 0;
            foreach ( $data as $index => $row ) {
                $faq = $this->_faqFactory->create();
                $faq->setData('title', $row[0]);
                $faq->setData('url_key', $row[1]);
                $faq->setData('category_ids', $row[2]);
                $faq->setData('content', $row[3]);
                $faq->setData('sort_order', $row[4]);
                $faq->setData('most_frequently', $row[5]);
                $faq->setData('meta_keywords', $row[6]);
                $faq->setData('meta_description', $row[7]);
                try {
                    $faq->getResource()->save($faq);
                    $faq->getResource()->saveUrlKey($faq);
                    $count++;
                } catch ( \Exception $e ) {
                }
            }
            $this->messageManager->addSuccessMessage(__("%1 FAQ(s) have been imported", $count));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }


}