<?php


namespace Metagento\Faq\Controller\Index;


class Index extends
    \Metagento\Faq\Controller\AbstractController
{
    protected $_connection;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Metagento\Faq\Helper\Data $helperData,
        \Metagento\Faq\Model\Template $faqTemplate,
        \Metagento\Faq\Model\CategoryFactory $categoryFactory,
        \Metagento\Faq\Model\FaqFactory $faqFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
        parent::__construct($context, $helperData, $faqTemplate, $categoryFactory, $faqFactory, $pageFactory, $storeManager, $registry);
        $this->_connection = $resourceConnection;
    }


    /**
     * @return $this|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        if ( $this->_faqTemplate->getMetaDescription() ) {
            $resultPage->getConfig()->setDescription($this->_faqTemplate->getMetaDescription());
        }
        if ( $this->_faqTemplate->getMetaKeywords() ) {
            $resultPage->getConfig()->setKeywords($this->_faqTemplate->getMetaKeywords());
        }
        return $resultPage;
    }
}
