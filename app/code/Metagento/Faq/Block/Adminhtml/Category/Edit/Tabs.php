<?php


namespace Metagento\Faq\Block\Adminhtml\Category\Edit;


class Tabs extends
    \Magento\Backend\Block\Widget\Tabs
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Framework\Registry $registry,
        array $data
    ) {
        parent::__construct($context, $jsonEncoder, $authSession, $data);
        $this->_registry = $registry;
    }

    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('category_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Category Information'));
    }

    /**
     * @return $this
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {
        if($this->isImport()){
            $this->addTab(
                'import',
                [
                    'label'   => __('Import Category'),
                    'title'   => __('Import Category'),
                    'content' => $this->getLayout()->createBlock('Metagento\Faq\Block\Adminhtml\Category\Edit\Tab\Import')->toHtml(),
                    'active'  => true,
                ]
            );
        }else{
            $this->addTab(
                'general',
                [
                    'label'   => __('General'),
                    'title'   => __('General'),
                    'content' => $this->getLayout()->createBlock('Metagento\Faq\Block\Adminhtml\Category\Edit\Tab\General')->toHtml(),
                    'active'  => true,
                ]
            );
            $this->addTab(
                'content',
                [
                    'label'   => __('Content'),
                    'title'   => __('Content'),
                    'content' => $this->getLayout()->createBlock('Metagento\Faq\Block\Adminhtml\Category\Edit\Tab\Content')->toHtml(),
                ]
            );
        }

        return parent::_beforeToHtml();
    }

    /**
     * check if this is a import form.
     * @return mixed
     */
    public function isImport()
    {
        return $this->_registry->registry('is_import');
    }
}