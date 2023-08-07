<?php
namespace Seonov\Customer\Block;


class Customer extends \Magento\Framework\View\Element\Template
{
    protected $customerSession;
    protected $_customerRepositoryInterface;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\Session $ession,
        array $data = []
    ) {

        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerSession = $ession;
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    public function getLoggedinCustomerId() {
        if ($this->customerSession->isLoggedIn()) {
            return $this->customerSession->getId();
        }
        return false;
    }
    public function getCustomerData() {
        if ($this->customerSession->isLoggedIn()) {
            //$customeratt = $this->_customerRepositoryInterface->getById($this->getLoggedinCustomerId());
            $customer = $this->customerSession->getCustomer();
            $customerData = $customer->getDataModel();
            return $customerData;
        }
        return false;
    }
}
