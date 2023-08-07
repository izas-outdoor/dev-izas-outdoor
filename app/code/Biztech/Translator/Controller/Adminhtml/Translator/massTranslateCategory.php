<?php

namespace Biztech\Translator\Controller\Adminhtml\Translator;

use Magento\Backend\App\Action\Context;
use Magento\Catalog\Model\Category;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Biztech\Translator\Helper\Language;
use Biztech\Translator\Helper\Translator;
use Biztech\Translator\Model\Translator as TranslatorModel;
use Magento\Framework\Json\EncoderInterface;
use Biztech\Translator\Helper\Data;
use Magento\Store\Model\StoreManagerInterface;

class massTranslateCategory extends \Magento\Backend\App\Action
{

    protected $scopeConfig;
    protected $_logger;
    protected $langHelper;
    protected $_transHelper;
    protected $_categoryModel;
    protected $_translatorModel;
    protected $_encoderInterface;
    protected $_translator;
    protected $_bizhelper;
    protected $_storeManager;


    /**
     * @param Context                                  $context
     * @param ScopeConfigInterface                     $scopeConfig
     * @param \Biztech\Translator\Helper\Logger\Logger $logger
     * @param Language                                 $langHelper
     * @param Translator                               $transHelper
     * @param TranslatorModel                          $translatorModel
     * @param EncoderInterface                         $encoderInterface
     * @param Category                                 $categoryModel
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        \Biztech\Translator\Helper\Logger\Logger $logger,
        Language $langHelper,
        Translator $transHelper,
        TranslatorModel $translatorModel,
        EncoderInterface $encoderInterface,
        Category $categoryModel,
        Data $bizhelper,
        StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->_logger = $logger;
        $this->langHelper = $langHelper;
        $this->_transHelper = $transHelper;
        $this->_categoryModel = $categoryModel;
        $this->_translatorModel = $translatorModel;
        $this->_encoderInterface = $encoderInterface;
        $this->_bizhelper = $bizhelper;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $categoryIds = $this->getRequest()->getParam('product_categories');
        
        if (array_key_exists(0, $categoryIds)) {
            $categoryIds = explode(',', $categoryIds[0]);
        }
        
        $storeId = $this->getRequest()->getParam('storeId');
        /**
        * 18-11-2019 |  - activation for specific storeview
        */
        $enable = $this->_bizhelper->enableSiteForStoreview($storeId);
        if (!$enable) {
            $result['text'] = 'error';
            $result['error'] = __('Couldn\'t work for the storeview : <b>'. $this->_storeManager->getStore($storeId)->getName().'</b> | Please enable Language Translator for this storeview from  <b> Stores → Configuration → AppJetty Extensions → AppJetty Language Translator → Translator Activation.</b>');
            $data = $this->_encoderInterface->encode($result);
            $this->getResponse()->setBody($data);
            return;
        }
        /* end */
        if ($storeId==0) {
            $istranslateInAllStoreview = $this->_bizhelper->getConfigValue('translator/general/translate_in_all_store_view');
            if ($istranslateInAllStoreview ==0 || $istranslateInAllStoreview==null) {
                $result['text'] = 'error';
                $result['error'] = "Category can not be translate in all store view.";
                $data = $this->_encoderInterface->encode($result);
                $this->getResponse()->setBody($data);
                return;
            }
        }


        $selectedCategoryCount = count($categoryIds);
        $translatedCategoryCount = 0;
        $languages = $this->langHelper->getLanguages();
        if ($this->getRequest()->getParam('lang_to') != 'locale') {
            $langto = $this->getRequest()->getParam('lang_to');
        } else {
            $langto = $this->_transHelper->getLanguage($storeId);
        }
        $langFrom = $this->_transHelper->getFromLanguage($storeId);
        try {
            $categoryFields = $this->scopeConfig->getValue('translator/general/massaction_category_translate_fields', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
           
            foreach ($categoryIds as $categoryId) {
                $categoryData = $this->_categoryModel->setStoreId($storeId)->load($categoryId);
                $finalAttributeSet = array_values(explode(',', $categoryFields));
                foreach ($finalAttributeSet as $attributeCode) {
                    $attributeCode = \str_replace('group_4', '', $attributeCode);
                    if (!isset($categoryData[$attributeCode]) || empty($categoryData[$attributeCode])) {
                        continue;
                    }
                    $translate = $this->_translatorModel->getTranslate($categoryData[$attributeCode], $langto, $langFrom);
                    if (isset($translate['status']) && $translate['status'] == 'fail') {
                        $error = sprintf('%d can\'t be translated for "Category : %s ". Error : %s', $categoryData['entity_id'], $attributeCode, $translate['text']);
                        $this->_logger->error($error);
                        $result['error'] = $error;
                        continue;
                    } else {
                        $categoryData->setData($attributeCode, $translate['text']);
                    }
                }
                try {
                    if ($categoryData->save()) {
                        $result['text'] = 'bingo';
                    }

                    if (isset($translate['status']) && $translate['status'] != 'fail') {
                        $translatedCategoryCount++;
                    }
                } catch (\Exception $e) {
                    $this->_logger->error($e->getMessage());
                    continue;
                }
            }
            if ($translatedCategoryCount == 0) {
                $result['error'] = __('There is no data to translate.');
            } else {
                $result['success'] = $translatedCategoryCount . ' Category of ' . $selectedCategoryCount . ' has been translated';
            }
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
            $result['error'] = $e->getMessage();
            return;
        }
        $data = $this->_encoderInterface->encode($result);
        $this->getResponse()->setBody($data);
    }
}
