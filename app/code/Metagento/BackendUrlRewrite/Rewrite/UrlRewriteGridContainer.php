<?php
/**
 * Created by Metagento.com
 * Date: 4/18/2019
 */

namespace Metagento\BackendUrlRewrite\Rewrite;


class UrlRewriteGridContainer extends \Magento\UrlRewrite\Block\GridContainer
{
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\UrlRewrite\Block\Selector $urlrewriteSelector,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        array $data = []
    ) {
        parent::__construct($context, $urlrewriteSelector, $data);
        $this->messageManager = $messageManager;
    }

    public function _construct()
    {
        $url     = $this->getUrl('backendurlrewrite/index/generateAll');
        $message = __("Please note this could take time!");
        $this->addButton(
            'generate_all',
            [
                'label'   => __("Regenerate All URL Rewrites"),
                'onclick' => "confirmSetLocation('$message','$url')",
                'class'   => 'add primary'
            ]
        );
        return parent::_construct();
    }

}