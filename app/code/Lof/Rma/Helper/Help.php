<?php
/**
 * LandOfCoder
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Venustheme.com license that is
 * available through the world-wide-web at this URL:
 * http://www.venustheme.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   LandOfCoder
 * @package    Lof_Rma
 * @copyright  Copyright (c) 2016 Venustheme (http://www.LandOfCoder.com/)
 * @license    http://www.LandOfCoder.com/LICENSE-1.0.html
 */



namespace Lof\Rma\Helper;

class Help extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Backend\Model\Url $backendUrlManager,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Store\Model\ResourceModel\Store\CollectionFactory $storeCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Helper\Context $context
    ) {
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->storeCollectionFactory = $storeCollectionFactory;
        $this->storeManager           = $storeManager;
        $this->backendUrlManager      = $backendUrlManager;
        $this->scopeConfig            = $scopeConfig;
        $this->context                = $context;
        parent::__construct($context);
    }
    /**
     * @param int $orderId
     * @return string
     */
    public function getBackendOrderUrl($orderId)
    {
        return $this->backendUrlManager->getUrl('sales/order/view', ['order_id' => $orderId]);
    }

    /**
     * @return \Magento\Sales\Model\ResourceModel\Order\Collection
     */
    public function getOrderCollection()
    {
        $collection = $this->orderCollectionFactory->create()
            ->setOrder('entity_id');

        return $collection;
    }

    public function getConfig($store = null,$config)
    {
      
        return $this->scopeConfig->getValue(
            $config,
             \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }
     /**
     * Also add to layout
     * <action method="addJs"><script>lof/core/jquery.min.js</script></action>
     * <action method="addJs"><script>lof/core/jquery.MultiFile.js</script></action>
     * @param int $storeId
     * @return string
     */
    public function getFileInput()
    {
       $allowedFiles =$this->getConfig($store = null,'rma/general/file_allowed_extensions');
         $allowedFiles = explode(',',  $allowedFiles);
         $allowedFiles = array_map('trim',  $allowedFiles);
         $alloweds = '';
        if (count($allowedFiles)) {
            $alloweds = implode('|', $allowedFiles);
        }

        return $alloweds;
    }



    /**
     * @param string $object
     * @param string $field
     * @return string
     */
    public function getStoreViewValue($object, $field)
    {
        $storeId = $object->getStoreId();
        if (!$storeId) {
            $storeId = $this->storeManager->getStore()->getId();
        }
        $serializedValue = $object->getData($field);
        $arr = $this->unserialize($serializedValue);
        $defaultValue = null;
        if (isset($arr[0])) {
            $defaultValue = $arr[0];
        }

        if (isset($arr[$storeId])) {
            $localizedValue = $arr[$storeId];
        } else {
            $localizedValue = $defaultValue;
        }

        return $localizedValue;
    }

    /**
     * @return array
     */
    public function getCoreStoreOptionArray()
    {
        $result = [];
        $arr = $this->storeCollectionFactory->create()->toArray();
        foreach ($arr['items'] as $value) {
            $result[$value['store_id']] = $value['name'];
        }

        return $result;
    }

    /**
     * @param string $object
     * @param string $field
     * @param string $value
     * @return void
     */
    public function setLocaleValue($object, $field, $value)
    {
        $storeId = (int) $object->getStoreId();
        $serializedValue = $object->getData($field);
        $arr = $this->unserialize($serializedValue);

        if ($storeId === 0) {
            $arr[0] = $value;
        } else {
            $arr[$storeId] = $value;
            if (!isset($arr[0])) {
                $arr[0] = $value;
            }
        }
        $object->setData($field, serialize($arr));
    }

    /**
     * @param string $object
     * @param string $field
     * @return null
     */
    public function getLocaleValue($object, $field)
    {
        $storeId = ($object->getStoreId()) ? (int) $object->getStoreId() : $this->storeManager->getStore()->getId();
        $serializedValue = $object->getData($field);
        $arr = $this->unserialize($serializedValue);
        // pr($arr);die;
        $defaultValue = null;
        if (isset($arr[0])) {
            $defaultValue = $arr[0];
        }

        if (isset($arr[$storeId])) {
            $localizedValue = $arr[$storeId];
        } else {
            $localizedValue = $defaultValue;
        }

        return $localizedValue;
    }

    /**
     * @param string $string
     * @return array
     */
    public function unserialize($string)
    {
        if (strpos($string, 'a:') !== 0) {
            return [0 => $string];
        }
        if (!$string) {
            return [];
        }
        try {
            return @unserialize($string);
        } catch (\Exception $e) {
            return [0 => $string];
        }
    }

    /**
     * @param int $timestamp
     * @param int $detailLevel
     * @return string
     */
    public function nicetime($timestamp, $detailLevel = 1)
    {
        $periods = ['sec', 'min', 'hour', 'day', 'week', 'month', 'year', 'decade'];
        $lengths = ['60', '60', '24', '7', '4.35', '12', '10'];

        $now = time();

        // check validity of date
        if (empty($timestamp)) {
            return 'Unknown ';
        }

        // is it future date or past date
        if ($now > $timestamp) {
            $difference = $now - $timestamp;
            $tense = 'ago';
        } else {
            $difference = $timestamp - $now;
            $tense = 'from now';
        }

        if ($difference == 0) {
            return '1 sec ago';
        }

        $remainders = [];

        for ($j = 0; $j < count($lengths); ++$j) {
            $remainders[$j] = floor(fmod($difference, $lengths[$j]));
            $difference = floor($difference / $lengths[$j]);
        }

        $difference = round($difference);

        $remainders[] = $difference;

        $string = '';

        for ($i = count($remainders) - 1; $i >= 0; --$i) {
            if ($remainders[$i]) {
                $string .= $remainders[$i].' '.$periods[$i];

                if ($remainders[$i] != 1) {
                    $string .= 's';
                }

                $string .= ' ';

                --$detailLevel;

                if ($detailLevel <= 0) {
                    break;
                }
            }
        }

        return $string.$tense;
    }

}
