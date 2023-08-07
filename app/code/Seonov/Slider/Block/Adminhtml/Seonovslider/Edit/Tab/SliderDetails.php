<?php
namespace Seonov\Slider\Block\Adminhtml\Seonovslider\Edit\Tab;
class SliderDetails extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
		/* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('slider_seonovslider');
		$isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('slider details')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

		$fieldset->addField(
            'sliderimage',
            'file',
            array(
                'name' => 'image',
                'label' => __('slider image'),
                'title' => __('slider image'),
                /*'required' => true,*/
            )
        );
        $fieldset->addField(
                'mobileimage',
                'file',
                array(
                    'name' => 'mobileimage',
                    'label' => __('Mobile image'),
                    'title' => __('mobile image'),
                    /*'required' => true,*/
                )
            );
		$fieldset->addField(
            'sliderbigtitle',
            'text',
            array(
                'name' => 'sliderbigtitle',
                'label' => __('slider big title'),
                'title' => __('slider big title'),
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'slidersmalltitle',
            'text',
            array(
                'name' => 'slidersmalltitle',
                'label' => __('slider small title'),
                'title' => __('slider small title'),
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'slidermenbtnlink',
            'text',
            array(
                'name' => 'slidermenbtnlink',
                'label' => __('slider 1st btn link'),
                'title' => __('slider 1st btn link'),
                /*'required' => true,*/
            )
        );
        $fieldset->addField(
                'slidermenbtntext',
                'text',
                array(
                    'name' => 'slidermenbtntext',
                    'label' => __('slider 1st btn Text'),
                    'title' => __('slider 1st btn Text'),
                    /*'required' => true,*/
                )
            );
		$fieldset->addField(
            'sliderwomenbtnlink',
            'text',
            array(
                'name' => 'sliderwomenbtnlink',
                'label' => __('slider 2nd btn link'),
                'title' => __('slider 2nd btn link'),
                /*'required' => true,*/
            )
        );
        $fieldset->addField(
                'sliderwomenbtntext',
                'text',
                array(
                    'name' => 'sliderwomenbtntext',
                    'label' => __('slider 2nd btn Text'),
                    'title' => __('slider 2nd btn Text'),
                    /*'required' => true,*/
                )
            );
            $fieldset->addField(
                    'sliderkidbtnlink',
                    'text',
                    array(
                        'name' => 'sliderkidbtnlink',
                        'label' => __('slider 3rd btn link'),
                        'title' => __('slider 3rd btn link'),
                        /*'required' => true,*/
                    )
                );
                $fieldset->addField(
                        'sliderkidbtntext',
                        'text',
                        array(
                            'name' => 'sliderkidbtntext',
                            'label' => __('slider 3rd btn Text'),
                            'title' => __('slider 3rd btn Text'),
                            /*'required' => true,*/
                        )
                    );
		/*{{CedAddFormField}}*/

        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('slider details');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('slider details');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
