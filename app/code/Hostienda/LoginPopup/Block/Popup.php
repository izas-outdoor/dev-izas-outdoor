<?php

namespace Hostienda\LoginPopup\Block;

use Magento\Directory\Helper\Data;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Url\Helper\Data as UrlHelper;
use Magento\Store\Model\Store;

class Popup extends \Magento\Framework\View\Element\Template
{
    /**
     * @var bool
     */
    protected $_storeInUrl;

    /**
     * @var \Magento\Framework\Data\Helper\PostHelper
     */
    protected $_postDataHelper;

    /**
     * @var UrlHelper
     */
    private $urlHelper;

    public function __construct(\Magento\Framework\Stdlib\CookieManagerInterface $cookieManager, \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager){
        $this->_cookieManager = $cookieManager;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function getShowPopup()
    {
        $showpopup = $this->_cookieManager->getCookie('showpopup');
      //  echo 'popup::';
       // print_r($showpopup);
        if (!empty($showpopup) && $showpopup == 'nop') {
            return 'no';
        } else {
            return 'yes';
        }

    }

    /**
     * Get current website Id.
     *
     * @return int|null|string
     */
    public function getCurrentWebsiteId()
    {
        return $this->_storeManager->getStore()->getWebsiteId();
    }
    /**
     * Get raw stores.
     *
     * @return array
     */
    public function getRawStores()
    {
        if (!$this->hasData('raw_stores')) {
            $websiteStores = $this->_storeManager->getWebsite()->getStores();
            echo 'store4';
            print_r($websiteStores);
            $stores = [];
            foreach ($websiteStores as $store) {

                /* @var $store \Magento\Store\Model\Store */
                if (!$store->isActive()) {
                    continue;
                }
                $localeCode = $this->_scopeConfig->getValue(
                    Data::XML_PATH_DEFAULT_LOCALE,
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                    $store
                );
                $store->setLocaleCode($localeCode);
                $params = ['_query' => []];
                if (!$this->isStoreInUrl()) {
                    $params['_query']['___store'] = $store->getCode();
                }
                $baseUrl = $store->getUrl('', $params);

                $store->setHomeUrl($baseUrl);
                $stores[$store->getGroupId()][$store->getId()] = $store;
            }
            $this->setData('raw_stores', $stores);
        }
        return $this->getData('raw_stores');
    }

    /* Get stores.
     *
     * @return \Magento\Store\Model\Store[]
     */
    public function getStores()
    {
        if (!$this->getData('stores')) {
            $rawStores = $this->getRawStores();

            $groupId = $this->getCurrentGroupId();
            if (!isset($rawStores[$groupId])) {
                $stores = [];
            } else {
                $stores = $rawStores[$groupId];
            }
            $this->setData('stores', $stores);
        }
        return $this->getData('stores');
    }

    /**
     * Get current store code.
     *
     * @return string
     */
    public function getCurrentStoreCode()
    {
        return $this->_storeManager->getStore()->getCode();
    }

    /**
     * Is store in url.
     *
     * @return bool
     */
    public function isStoreInUrl()
    {
        if ($this->_storeInUrl === null) {
            $this->_storeInUrl = $this->_storeManager->getStore()->isUseStoreInUrl();
        }
        return $this->_storeInUrl;
    }

    /**
     * Get store code.
     *
     * @return string
     */
    public function getStoreCode()
    {
        return $this->_storeManager->getStore()->getCode();
    }

    /**
     * Get store name.
     *
     * @return null|string
     */
    public function getStoreName()
    {
        return $this->_storeManager->getStore()->getName();
    }

    /**
     * Returns target store post data.
     *
     * @param Store $store
     * @param array $data
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getTargetStorePostData(Store $store, $data = [])
    {
        $data[\Magento\Store\Model\StoreManagerInterface::PARAM_NAME] = $store->getCode();
        $data['___from_store'] = $this->_storeManager->getStore()->getCode();

        $urlOnTargetStore = $store->getCurrentUrl(false);
        $data[ActionInterface::PARAM_NAME_URL_ENCODED] = $this->urlHelper->getEncodedUrl($urlOnTargetStore);

        $url = $this->getUrl('stores/store/redirect');

        return $this->_postDataHelper->getPostData(
            $url,
            $data
        );
    }

}
