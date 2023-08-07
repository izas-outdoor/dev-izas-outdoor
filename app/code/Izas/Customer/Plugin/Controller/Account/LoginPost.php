<?php
namespace Izas\Customer\Plugin\Controller\Account;

use Magento\Framework\UrlInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Checkout\Helper\Cart;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Customer\Model\Account\Redirect as AccountRedirect;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\ResponseFactory;

/**
 * Class LoginPost
 * @package Izas\Customer\Plugin\Controller\Account
 */
class LoginPost
{
    /**
     * @var UrlInterface
     */
    protected $urlModel;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @var RedirectInterface
     */
    protected $redirect;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

        /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * LoginPost constructor.
     * @param UrlInterface $urlModel
     * @param RedirectFactory $resultRedirectFactory
     * @param RedirectInterface $redirect
     * @param RequestInterface $request
     * @param Cart $cartHelper
     * @param AccountRedirect $accountRedirect
     * @param ResponseFactory $responseFactory
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        UrlInterface $urlModel,
        RedirectFactory $resultRedirectFactory,
        RedirectInterface $redirect,
        RequestInterface $request,
        Cart $cartHelper,
        AccountRedirect $accountRedirect,
        ManagerInterface $messageManager,
        ResponseFactory $responseFactory
    ) {
        $this->urlModel = $urlModel;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->redirect = $redirect;
        $this->request = $request;
        $this->cartHelper = $cartHelper;
        $this->accountRedirect = $accountRedirect;
        $this->messageManager = $messageManager;
        $this->responseFactory = $responseFactory;
    }
    
    /**
     * @param \Seonov\Customer\Controller\Account\CreatePost $subject
     * @param callable $proceed
     * @return $this
     */
    public function afterExecute()
    {      
        if ($this->cartHelper->getItemsCount() > 0) {
            $url = $this->urlModel->getUrl('checkout');

            $result = $this->responseFactory->create()->setRedirect($url)->sendResponse('200');
        } else {
            $url = $this->urlModel->getUrl('customer/account');

            $result = $this->responseFactory->create()->setRedirect($url)->sendResponse('200');
        }

        return $result;
    }

}