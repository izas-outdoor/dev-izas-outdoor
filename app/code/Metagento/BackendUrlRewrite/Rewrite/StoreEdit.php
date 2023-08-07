<?php
/**
 * Created by Metagento.com
 * Date: 4/19/2019
 */

namespace Metagento\BackendUrlRewrite\Rewrite;


class StoreEdit extends \Magento\Backend\Block\System\Store\Edit
{
    protected function _construct()
    {
        $storeId = $this->getRequest()->getParam('store_id');
        $url     = $this->getUrl('backendurlrewrite/store/generate', array('id' => $storeId));
        $message = __("This will take time.");
        $this->addButton(
            'generate_url_rewrite',
            [
                'label'   => __("Generate URL Rewrites"),
                'onclick' => "confirmSetLocation('$message','$url')",
                'class'   => 'add primary'
            ]
        );
        return parent::_construct();
    }

}