<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element;

/**
 * Class CustomerLink
 * @package WebPanda\Rma\Block\Adminhtml\Rma\Edit\Tab\Element
 */
class CustomerLink extends \Magento\Framework\Data\Form\Element\AbstractElement
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * CustomerLink constructor.
     * @param \Magento\Framework\Data\Form\Element\Factory $factoryElement
     * @param \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection
     * @param \Magento\Framework\Escaper $escaper
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Customer\Model\CustomerFactory $customerFactory
     * @param \Magento\Framework\UrlInterface $url
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Data\Form\Element\Factory $factoryElement,
        \Magento\Framework\Data\Form\Element\CollectionFactory $factoryCollection,
        \Magento\Framework\Escaper $escaper,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\UrlInterface $url,

        $data = []
    ) {
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
        $this->coreRegistry = $registry;
        $this->customerFactory = $customerFactory;
        $this->url = $url;
    }

    /**
     * Retrieve Element HTML
     *
     * @return string
     */
    public function getElementHtml()
    {
        $html = $this->getBold() ? '<div class="control-value special">' : '<div class="control-value">';
        $html .= $this->getCustomerLink() . '</div>';
        $html .= $this->getAfterElementHtml();
        return $html;
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    protected function getCustomerLink()
    {
        $customer = $this->customerFactory->create()->load($this->getValue());
        $rma = $this->coreRegistry->registry('rma_request');

        if ($customer->getId()) {
            $link = $this->url->getUrl(
                'customer/index/edit',
                ['id' => $customer->getId()]
            );
            return '<a href="' . $link . '" target="_blank">' . $customer->getName() . '</a>';
        } else {
            return $rma->getFinalCustomerName();
        }
    }
}
