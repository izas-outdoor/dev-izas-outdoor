<?php


namespace Metagento\Faq\Model;


class Template extends
    \Magento\Framework\DataObject
{
    protected $_templateData
        = array(
            '1' => array(
                'layout' => array(
                    'template' => 'template1/faq.phtml',
                    'children' => array(
                        array(
                            'name'     => 'faq.category',
                            'alias'    => 'faq.category',
                            'block'    => 'Metagento\Faq\Block\Content\Category',
                            'template' => 'template1/category.phtml',
                        ),
                        array(
                            'name'     => 'faq.faqlist',
                            'alias'    => 'faq.faqlist',
                            'block'    => 'Metagento\Faq\Block\Content\Faqlist',
                            'template' => 'template1/faqlist.phtml',
                        ),
                    ),
                ),
                'css'    => array(
                    'Metagento_Faq::template1/css/style.css',
                ),
                'js'     => array(
                    'Metagento_Faq::template1/js/jquery.mobile.custom.min.js',
                    'Metagento_Faq::template1/js/jquery-2.1.1.js',
                    'Metagento_Faq::template1/js/main.js',
                    'Metagento_Faq::template1/js/modernizr.js',
                ),
            ),
            '2' => array(
                'layout' => array(
                    'template' => 'template2/faq.phtml',
                    'children' => array(
                        array(
                            'name'     => 'faq.category',
                            'alias'    => 'faq.category',
                            'block'    => 'Metagento\Faq\Block\Content\Category',
                            'template' => 'template2/category.phtml',
                        ),
                        array(
                            'name'     => 'faq.faqlist',
                            'alias'    => 'faq.faqlist',
                            'block'    => 'Metagento\Faq\Block\Content\Faqlist',
                            'template' => 'template2/faqlist.phtml',
                        ),
                    ),
                ),
                'css'    => array(
                    'Metagento_Faq::bootstrap/css/library.css',
                    'Metagento_Faq::template2/css/style.css',
                ),
                'js'     => array(
                    'Metagento_Faq::js/jquery.js',
                    'Metagento_Faq::bootstrap/js/bootstrap.min.js',
                    'Metagento_Faq::template2/js/main.js',
                ),
            ),
        );

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($data);
    }

    public function getTemplateId()
    {
        return $this->_scopeConfig->getValue('faq/general/template');
    }

    public function showMostFaq()
    {
        return true;
//        return $this->_scopeConfig->getValue('faq/general/show_most');
    }

    public function showSideBar()
    {
        return $this->_scopeConfig->getValue('faq/general/show_sidebar');
    }

    public function getMetaDescription()
    {
        return $this->_scopeConfig->getValue('faq/general/meta_description');
    }

    public function getMetaKeywords()
    {
        return $this->_scopeConfig->getValue('faq/general/meta_keywords');
    }

    public function getCustomCss()
    {
        return $this->_scopeConfig->getValue('faq/general/custom_css');
    }


    /**
     * @return array
     */
    public function getCssPath()
    {
        $id = $this->getTemplateId();
        return $this->_templateData[$id]['css'];
    }

    /**
     * @return array
     */
    public function getJsPath()
    {
        $id = $this->getTemplateId();
        return $this->_templateData[$id]['js'];
    }


    /**
     * @return array
     */
    public function getTemplatePath()
    {
        $id = $this->getTemplateId();
        return $this->_templateData[$id]['template'];
    }

    public function getLayout()
    {
        $id = $this->getTemplateId();
        return $this->_templateData[$id]['layout'];
    }



}