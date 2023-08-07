<?php


namespace Metagento\Faq\Block\Adminhtml\Faq\Edit;


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
        $this->_registry = $registry;
        parent::__construct($context, $jsonEncoder, $authSession, $data);
    }

    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('faq_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('FAQ Information'));
    }

    /**
     * @return $this
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {
        if ( $this->isImport() ) {
            $this->addTab(
                'import',
                [
                    'label'   => __('Import FAQ'),
                    'title'   => __('Import FAQ'),
                    'content' => $this->getLayout()->createBlock('Metagento\Faq\Block\Adminhtml\Faq\Edit\Tab\Import')->toHtml(),
                    'active'  => true,
                ]
            );
        } else {
            $this->addTab(
                'general',
                [
                    'label'   => __('General'),
                    'title'   => __('General'),
                    'content' => $this->getLayout()->createBlock('Metagento\Faq\Block\Adminhtml\Faq\Edit\Tab\General')->toHtml(),
                    'active'  => true,
                ]
            );
            $this->addTab(
                'content',
                [
                    'label'   => __('Content'),
                    'title'   => __('Content'),
                    'content' => $this->getLayout()->createBlock('Metagento\Faq\Block\Adminhtml\Faq\Edit\Tab\Content')->toHtml(),
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