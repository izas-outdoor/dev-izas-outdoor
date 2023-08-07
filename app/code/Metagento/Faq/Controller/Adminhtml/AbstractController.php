<?php


namespace Metagento\Faq\Controller\Adminhtml;


abstract class AbstractController extends
    \Magento\Backend\App\Action
{
    /**
     * @var \Metagento\Faq\Model\CategoryFactory
     */
    protected $_categoryFactory;
    /**
     * @var \Metagento\Faq\Model\FaqFactory
     */
    protected $_faqFactory;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;
    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $_resultLayoutFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Metagento\Faq\Model\FaqFactory $faqFactory,
        \Metagento\Faq\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
    ) {
        \Magento\Backend\App\Action::__construct($context);
        $this->_faqFactory          = $faqFactory;
        $this->_categoryFactory     = $categoryFactory;
        $this->_resultPageFactory   = $pageFactory;
        $this->_registry            = $registry;
        $this->_resultLayoutFactory = $resultLayoutFactory;
    }

}