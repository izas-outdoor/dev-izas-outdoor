<?php

namespace Seonov\Customer\Controller\Preference;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $session;
    protected $messageManager;
    protected $resultRedirectFactory;

    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->session = $customerSession;
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->session->isLoggedIn()) {
            $this->session->authenticate();
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $urlInterface = $objectManager->create('Magento\Framework\UrlInterface');

            $url = $urlInterface->getUrl('cusacc/preference/index');

            // Create login URL
            $login_url = $urlInterface
                ->getUrl('customer/account/login',
                    array('referer' => base64_encode($url))
                );
            return $this->resultRedirectFactory->create()->setPath($login_url);

        } else {
            if ($this->_request->getPost()) {
                $customer = $this->session->getCustomer();
                $customerData = $customer->getDataModel();
                if ($this->_request->getPost('skiing')) {
                    $customerData->setCustomAttribute('skiing', 1);
                } else {
                    $customerData->setCustomAttribute('skiing', 0);
                }
                if ($this->_request->getPost('running')) {
                    $customerData->setCustomAttribute('running', 1);
                } else {
                    $customerData->setCustomAttribute('running', 0);
                }
                if ($this->_request->getPost('cycling')) {
                    $customerData->setCustomAttribute('cycling', 1);
                } else {
                    $customerData->setCustomAttribute('cycling', 0);
                }
                if ($this->_request->getPost('climbing')) {
                    $customerData->setCustomAttribute('climbing', 1);
                } else {
                    $customerData->setCustomAttribute('climbing', 0);
                }
                if ($this->_request->getPost('kids')) {
                    $customerData->setCustomAttribute('kids', 1);
                } else {
                    $customerData->setCustomAttribute('kids', 0);
                }
                if ($this->_request->getPost('fashion')) {
                    $customerData->setCustomAttribute('fashion', 1);
                } else {
                    $customerData->setCustomAttribute('fashion', 0);
                }
                if ($this->_request->getPost('hiking')) {
                    $customerData->setCustomAttribute('hiking', 1);
                } else {
                    $customerData->setCustomAttribute('hiking', 0);
                }
                $customer->updateData($customerData);
                $customer->save();
                $this->messageManager->addSuccess(__("Your preference has changed"));
            }
        }


        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;

    }
}
