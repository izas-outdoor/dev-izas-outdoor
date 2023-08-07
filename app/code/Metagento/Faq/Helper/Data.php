<?php

namespace Metagento\Faq\Helper;


use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends
    AbstractHelper
{
    public function __construct(
        Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Store\Model\StoreFactory $storeFactory
    ) {
        $this->_storeManager = $storeManager;
        $this->_storeFactory = $storeFactory;
        parent::__construct($context);
    }

    public function getStoreIdFromCode( $storeCode )
    {
        return $this->_storeFactory->create()->load($storeCode, 'code');
    }

    public function getStoreIdsFromCodes( $codes )
    {
        $codes = explode(',', $codes);
        $ids   = array();
        foreach ( $codes as $code ) {
            $store = $this->getStoreIdFromCode($code);
            if ( $store->getId() ) {
                $ids[] = $store->getId();
            }
        }
        return implode(',', $ids);
    }
}