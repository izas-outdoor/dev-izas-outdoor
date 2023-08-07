<?php


namespace Metagento\Faq\Block;


class Content extends
    \Magento\Framework\View\Element\Template
{
    /**
     * @var \Metagento\Faq\Model\Template
     */
    protected $_faqTemplate;

    /**
     * @var \Metagento\Faq\Model\FaqFactory
     */
    protected $_faqFactory;

    /**
     * @var \Metagento\Faq\Model\CategoryFactory
     */
    protected $_categoryFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Metagento\Faq\Model\Template $template,
        \Metagento\Faq\Model\FaqFactory $faqFactory,
        \Metagento\Faq\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_faqTemplate     = $template;
        $this->_faqFactory      = $faqFactory;
        $this->_categoryFactory = $categoryFactory;
        $this->_registry        = $registry;
        \Magento\Framework\View\Element\Template::__construct($context, $data);
    }

    protected function _prepareLayout()
    {
        $layout = $this->_faqTemplate->getLayout();
        $this->setTemplate($layout['template']);
        $children = $layout['children'];
        foreach ( $children as $child ) {
            $this->setChild($child['alias'],
                            $this->getLayout()
                                 ->createBlock($child['block'], $child['name'])
                                 ->setTemplate($child['template'])
            );
        }
        return parent::_prepareLayout();
    }

    protected
    function _beforeToHtml()
    {
        parent::_beforeToHtml();
    }

    /**
     * get Categories for current store.
     * @return \Metagento\Faq\Model\ResourceModel\Category\Collection
     */
    public
    function getCategories()
    {
        /** @var \Metagento\Faq\Model\ResourceModel\Category\Collection $collection */
        $collection = $this->_categoryFactory->create()->getCollection();
        return $collection->getCurrentStoreCategories();
    }

    public
    function getMostFaqs()
    {
        /** @var \Metagento\Faq\Model\ResourceModel\Faq\Collection $collection */
        $collection = $this->_faqFactory->create()->getCollection();
        return $collection->getMostFaqs();
    }

    /**
     * get current store
     * @return \Magento\Store\Api\Data\StoreInterface
     */
    public
    function getStore()
    {
        return $this->_storeManager->getStore();
    }

    public
    function showMostFaq()
    {
        return $this->_faqTemplate->showMostFaq();
    }

    public
    function showSidebar()
    {
        return $this->_faqTemplate->showSideBar();
    }

    public
    function getSelectedCategory()
    {
        $category = $this->_registry->registry('faq_category');
        if ( $category && $category->getId() ) {
            return $category;
        }
        return null;
    }

    public
    function getSelectedFaq()
    {
        $faq = $this->_registry->registry('faq');
        if ( $faq && $faq->getId() ) {
            return $faq;
        }
        return null;
    }
}