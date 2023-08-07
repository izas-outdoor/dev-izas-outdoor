<?php


namespace Metagento\Faq\Controller\Adminhtml\Category;


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
            $count      = 0;
            $storeError = false;
            foreach ( $data as $index => $row ) {
                $storeIds = $this->_faqHelper->getStoreIdsFromCodes($row[2]);
                if ( !$storeIds ) {
                    continue;
                    $storeError = true;
                }
                $category = $this->_categoryFactory->create();
                $category->setData('name', $row[0]);
                $category->setData('url_key', $row[1]);
                $category->setData('store_ids', $storeIds);
                $category->setData('sort_order', $row[3]);
                $category->setData('meta_keywords', $row[4]);
                $category->setData('meta_description', $row[5]);
                try {
                    $category->getResource()->save($category);
                    $category->getResource()->saveUrlKey($category);
                    $count++;
                } catch ( \Exception $e ) {
                }
            }
            $this->messageManager->addSuccessMessage(__("%1 category(s) have been imported", $count));
            if ( $storeError ) {
                $this->messageManager->addErrorMessage(__("Please check again store code"));
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }


}