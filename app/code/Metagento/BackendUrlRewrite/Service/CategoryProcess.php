<?php
/**
 * Created by Metagento.com
 * Date: 4/18/2019
 */

namespace Metagento\BackendUrlRewrite\Service;


class CategoryProcess extends ProcessAbstract
{
    protected $_pageSize = 100;


    /**
     * @param array $storeIds
     */
    public function generateAllCategories($storeIds = [])
    {
        $this->generateCategories([], $storeIds);
    }


    /**
     * @param array $ids
     * @param array $storeIds
     */
    public function generateCategories($ids = [], $storeIds = [])
    {
        if (!count($storeIds)) {
            $storeIds = $this->getAllStoreIds();
        }
        foreach ($storeIds as $storeId) {
            $categoryCollection = $this->_getCategoryCollection($ids, $storeId);
            $pageCount          = $categoryCollection->getLastPageNumber();
            $currentPage        = 1;
            while ($currentPage <= $pageCount) {
                $categoryCollection->setCurPage($currentPage);
                foreach ($categoryCollection as $category) {
                    $this->_categoryProcess($category, $storeId);
                }
                $categoryCollection->clear();
                $currentPage++;
            }
        }
    }

    /**
     * @param $category
     * @param int $storeId
     */
    protected function _categoryProcess($category, $storeId = 0)
    {
        try {
            $category->setData('save_rewrites_history', true);
            $category->setStoreId($storeId);
            $category->setUrlKey($category->formatUrlKey($category->getName()));
            $category->getResource()->saveAttribute($category, 'url_key');
            $category->setUrlPath($this->_categoryUrlPathGenerator->getUrlPath($category));
            $category->getResource()->saveAttribute($category, 'url_path');

            $this->_regenerateCategoryUrlRewrites($category, $storeId);
            $this->_resetUrlRewritesDataMaps($category);

        } catch (\Exception $e) {
            $this->addError($e->getMessage() . ' Category ID: ' . $category->getId());
        }
    }

    /**
     * @param $category
     * @param $storeId
     */
    protected function _regenerateCategoryUrlRewrites($category, $storeId)
    {
        try {
            $category->setStore($storeId);
            $category->setChangedProductIds(true);
            $categoryUrlRewriteResult = $this->_categoryUrlRewriteGenerator->generate($category, true);
            $this->_doBunchReplaceUrlRewrites($categoryUrlRewriteResult);

            // if config option "Use Categories Path for Product URLs" is "Yes"
            if ($this->_getUseCategoriesPathForProductUrlsConfig($storeId)) {
                $productUrlRewriteResult = $this->_urlRewriteHandler->generateProductUrlRewrites($category);
                // fix for double slashes issue and dots
                foreach ($productUrlRewriteResult as &$urlRewrite) {
                    $urlRewrite->setRequestPath($this->_clearRequestPath($urlRewrite->getRequestPath()));
                }
                $this->_doBunchReplaceUrlRewrites($productUrlRewriteResult, 'Product');
            }
        } catch (\Exception $e) {
            $this->addError($e->getMessage() . ' Category ID: ' . $category->getId());
        }
    }

    /**
     * @param $category
     */
    protected function _resetUrlRewritesDataMaps($category)
    {
        foreach ($this->_dataUrlRewriteClassNames as $className) {
            $this->_databaseMapPool->resetMap($className, $category->getEntityId());
        }
    }

    /**
     * @param int $storeId
     * @param array $ids
     * @return mixed
     */
    protected function _getCategoryCollection($ids = [], $storeId = 0)
    {
        $categoryCollection = $this->_categoryCollectionFactory->create();

        $categoryCollection->addAttributeToSelect('name')
            ->addAttributeToSelect('url_key')
            ->addAttributeToSelect('url_path')
            ->addFieldToFilter('level', array('gt' => '1'))
            ->setOrder('level', 'DESC')
            ->setPageSize($this->_pageSize);
        $rootCategoryId = $this->_getStoreRootCategoryId($storeId);
        if ($rootCategoryId > 0) {
            $categoryCollection->addAttributeToFilter('path', array('like' => "1/{$rootCategoryId}/%"));
        }
        if (count($ids) > 0) {
            $categoryCollection->addIdFilter($ids);
        }
        return $categoryCollection;
    }

    /**
     * @param $storeId
     * @return int
     */
    protected function _getStoreRootCategoryId($storeId)
    {
        $tableName1 = $this->_resource->getTableName('store_group');
        $tableName2 = $this->_resource->getTableName('store');
        $sql        = "SELECT t1.root_category_id FROM {$tableName1} t1 INNER JOIN {$tableName2} t2 ON t2.website_id = t1.website_id WHERE t2.store_id = {$storeId};";

        $result = (int)$this->_resource->getConnection()->fetchOne($sql);

        return $result;
    }
}