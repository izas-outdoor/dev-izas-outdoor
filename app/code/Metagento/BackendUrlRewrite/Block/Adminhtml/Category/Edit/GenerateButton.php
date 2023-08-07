<?php
/**
 * Created by Metagento.com
 * Date: 4/19/2019
 */

namespace Metagento\BackendUrlRewrite\Block\Adminhtml\Category\Edit;


class GenerateButton extends \Magento\Catalog\Block\Adminhtml\Category\AbstractCategory
    implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    /**
     * Save button
     *
     * @return array
     */
    public function getButtonData()
    {
        $category   = $this->getCategory();
        $categoryId = (int)$category->getId();

        if ($categoryId) {
            $storeId = $this->getRequest()->getParam('store');
            $message = __("This could take time, depends on number of sub-categories");
            $url     = $this->getUrl('backendurlrewrite/category/generate',
                array('id' => $categoryId, 'storeId' => $storeId));
            return [
                'id'         => 'generate_url_rewrite',
                'label'      => __('Generate URL Rewrites (including sub-category)'),
                'on_click'   => "confirmSetLocation('$message','$url')",
                'class'      => 'save primary',
                'sort_order' => -100
            ];
        }
        return [];
    }

}