<?php


namespace Metagento\Faq\Controller;


abstract class AbstractController extends
    \Magento\Framework\App\Action\Action
{
    /**
     * @var \Metagento\Faq\Helper\Data
     */
    protected $_faqHelper;

    /**
     * @var \Metagento\Faq\Model\Template
     */
    protected $_faqTemplate;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * @var \Metagento\Faq\Model\CategoryFactory
     */
    protected $_categoryFactory;

    /**
     * @var \Metagento\Faq\Model\FaqFactory
     */
    protected $_faqFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Metagento\Faq\Helper\Data $helperData,
        \Metagento\Faq\Model\Template $faqTemplate,
        \Metagento\Faq\Model\CategoryFactory $categoryFactory,
        \Metagento\Faq\Model\FaqFactory $faqFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry
    ) {
        $this->_faqHelper       = $helperData;
        $this->_faqTemplate     = $faqTemplate;
        $this->_pageFactory     = $pageFactory;
        $this->_storeManager    = $storeManager;
        $this->_registry        = $registry;
        $this->_categoryFactory = $categoryFactory;
        $this->_faqFactory      = $faqFactory;
        parent::__construct($context);
    }

}