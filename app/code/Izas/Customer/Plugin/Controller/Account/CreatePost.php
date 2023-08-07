<?php
namespace Izas\Customer\Plugin\Controller\Account;

use Magento\Framework\UrlInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Checkout\Helper\Cart;
use Magento\Framework\App\ResponseFactory;

/**
 * Class CreatePost
 * @package Izas\Customer\Plugin\Controller\Account
 */
class CreatePost
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
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * CreatePost constructor.
     * @param UrlInterface $urlModel
     * @param RedirectFactory $resultRedirectFactory
     * @param RedirectInterface $redirect
     * @param RequestInterface $request
     * @param ResponseFactory $responseFactory
     * @param Cart $cartHelper
     * @param CustomerExtractor $customerExtractor
     */
    public function __construct(
        UrlInterface $urlModel,
        RedirectFactory $resultRedirectFactory,
        RedirectInterface $redirect,
        RequestInterface $request,
        Cart $cartHelper,
        ResponseFactory $responseFactory    
        ) {
        $this->urlModel = $urlModel;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->redirect = $redirect;
        $this->request = $request;
        $this->cartHelper = $cartHelper;
        $this->responseFactory = $responseFactory;
    }

    public function beforeExecute(){
        //$guest = $this->request->getPost('guest');
        if(isset($_REQUEST['guest']) && $_REQUEST['guest']){
            $length = 5;
            $key = "";
            $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
            $pattern2 = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $max = strlen($pattern)-1;
            for($i = 0; $i < $length; $i++){
                $key .= substr($pattern, mt_rand(0,$max), 1);
            }
            $max = strlen($pattern2)-1;
            for($i = 0; $i < $length; $i++){
                $key .= substr($pattern2, mt_rand(0,$max), 1);
            }
            $email = $this->request->getPost('email');
            $pos = strpos($email, '@');
            $iniEmail = substr($email, 0, $pos);
            $endEmail = substr($email, $pos, strlen($email));
            $email = $iniEmail."+invitado".time().$endEmail;
    
            $_REQUEST['email'] = $email;
            $_REQUEST['password'] = $key;
            $_REQUEST['password_confirmation'] = $key;
            $_REQUEST['firstname'] = "Nombre";
            $_REQUEST['lastname'] = "Apellidos";
            $_REQUEST['day'] = 1;
            $_REQUEST['month'] = 1;
            $_REQUEST['year'] = 1990;
            $_REQUEST['privacity'] = 1;
            $this->request->setPostValue('email', $email);
            $this->request->setPostValue('password', $key);
            $this->request->setPostValue('password_confirmation', $key);
            $this->request->setPostValue('firstname', "Nombre");
            $this->request->setPostValue('lastname', "Apellidos");
            $this->request->setPostValue('privacity', 1);
        }
    }
    /**
     * @param \Seonov\Customer\Controller\Account\CreatePost $subject
     * @param callable $proceed
     * @return $this
     */
    public function aroundExecute(\Seonov\Customer\Controller\Account\CreatePost $subject, callable $proceed)
    {
        if (!$privacy = $this->request->getPost('privacity')) {
            $url = $this->urlModel->getUrl('*/*/create', ['_secure' => true]);
            $result = $this->resultRedirectFactory->create()->setUrl($this->redirect->error($url));
        } else {
            $result = $proceed();
        }

        return $result;
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