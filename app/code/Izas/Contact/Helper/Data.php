<?php
namespace Izas\Contact\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Asset\Repository as AssetRepository;
use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Customer\Helper\View as CustomerViewHelper;
use Magento\Shipping\Model\Config;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Data
 * @package Izas\Contact\Helper
 */
class Data extends \Magento\Contact\Helper\Data
{
    /**
     * @var AssetRepository
     */
    protected $assetRepo;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Data constructor.
     * @param Context $context
     * @param Session $customerSession
     * @param CustomerViewHelper $customerViewHelper
     * @param AssetRepository $assetRepo
     * @param RequestInterface $request
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        CustomerViewHelper $customerViewHelper,
        AssetRepository $assetRepo,
        RequestInterface $request
    ) {
        $this->assetRepo = $assetRepo;
        $this->request = $request;
        parent::__construct($context, $customerSession, $customerViewHelper);
    }

    /**
     * @return string
     */
    public function getUserLastname()
    {
        if (!$this->_customerSession->isLoggedIn()) {
            return '';
        }
        /**
         * @var \Magento\Customer\Api\Data\CustomerInterface $customer
         */
        $customer = $this->_customerSession->getCustomerDataObject();

        return trim($customer->getLastname());
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        if (!$this->_customerSession->isLoggedIn()) {
            return '';
        }
        /**
         * @var \Magento\Customer\Api\Data\CustomerInterface $customer
         */
        $customer = $this->_customerSession->getCustomerDataObject();

        return trim($customer->getFirstname());
    }

    /**
     * @return mixed
     */
    public function getAllowedCountries()
    {
        return $this->scopeConfig->getValue('general/country/allow', ScopeInterface::SCOPE_STORE);
    }

    /**
     * @param $file
     * @return string
     */
    protected function getViewFileUrl($file)
    {
        try {
            $params = ['_secure' => $this->request->isSecure()];
            return $this->assetRepo->getUrlWithParams($file, $params);
        } catch (LocalizedException $e) {
            return '';
        }
    }

    /**
     * @return string
     */
    public function getUtilsScript()
    {
        return $this->getViewFileUrl('Wetrust_Checkout::js/view/checkout/utils.min.js');
    }

    /**
     * @return mixed
     */
    public function getInitialCountry()
    {
        return $this->scopeConfig->getValue(Config::XML_PATH_ORIGIN_COUNTRY_ID, ScopeInterface::SCOPE_STORE);
    }
}

