<?php
/**
 * @author      WebPanda
 * @package     WebPanda_Rma
 * @copyright   Copyright (c) WebPanda (https://webpanda-solutions.com/)
 * @license     https://webpanda-solutions.com/license-agreement
 */
namespace WebPanda\Rma\Block\Guest\Rma;

/**
 * Class NewReturn
 * @package WebPanda\Rma\Block\Guest\Rma
 */
class NewReturn extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Url
     */
    protected $customerUrl;

    /**
     * NewReturn constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Url $customerUrl
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Url $customerUrl,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerUrl = $customerUrl;
    }

    /**
     * @return string
     */
    public function getLoginPostUrl()
    {
        return $this->customerUrl->getLoginPostUrl();
    }

    /**
     * @return string
     */
    public function getForgotPasswordUrl()
    {
        return $this->customerUrl->getForgotPasswordUrl();
    }

    /**
     * @return string
     */
    public function getNextPostUrl()
    {
        return $this->getUrl('*/*/createReturn');
    }
}
