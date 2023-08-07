<?php
/**
 * Created by Metagento.com
 */

namespace Metagento\BackendUrlRewrite\Service;


class ProductProcess extends ProcessAbstract
{
    protected $pageSize = 1000;

    /**
     * @param array $storeIds
     */
    public function generateAllProducts($storeIds = [])
    {
        $this->generateProducts([], $storeIds);
    }


    /**
     * @param array $ids
     * @param array $storeIds
     */
    public function generateProducts($ids = [], $storeIds = [])
    {
        if (!count($storeIds)) {
            $storeIds = $this->getAllStoreIds();
        }
        foreach ($storeIds as $storeId) {
            $productCollection = $this->_getProductCollection($ids, $storeId);
            $pageCount         = $productCollection->getLastPageNumber();
            $currentPage       = 1;
            while ($currentPage <= $pageCount) {
                $productCollection->clear();
                $productCollection->setCurPage($currentPage);
                foreach ($productCollection as $product) {
                    $this->_process($product, $storeId);
                }
                $currentPage++;
            }
        }
    }


    /**
     * @param $product
     * @param $storeId
     */
    protected function _process($product, $storeId)
    {
        try {
            $product->setData('save_rewrites_history', true);
            $product->setData('url_path', null)
                ->setData('url_key', null)
                ->setStoreId($storeId);

            $generatedKey = $this->_productUrlPathGenerator->getUrlKey($product);

            $product->setData('url_key', $generatedKey);

            $this->_productAction->updateAttributes(
                [$product->getId()],
                ['url_path' => null, 'url_key' => $generatedKey],
                $storeId
            );

            $productUrlRewriteResult = $this->_productUrlRewriteGenerator->generate($product);
            $productUrlRewriteResult = $this->clearProductUrlRewrites($productUrlRewriteResult);

            try {
                $this->_urlPersist->replace($productUrlRewriteResult);
            } catch (\Exception $e) {
                $this->addError($e->getMessage() . ' Product ID: ' . $product->getId());
            }
        } catch (\Exception $e) {
            $this->addError($e->getMessage() . ' Product ID: ' . $product->getId());
        }
    }

    /**
     * @param $productUrlRewrites
     * @return mixed
     */
    protected function clearProductUrlRewrites($productUrlRewrites)
    {
        $paths = [];
        foreach ($productUrlRewrites as $key => $urlRewrite) {
            $path = $this->_clearRequestPath($urlRewrite->getRequestPath());
            if (!in_array($path, $paths)) {
                $productUrlRewrites[$key]->setRequestPath($path);
                $paths[] = $path;
            } else {
                unset($productUrlRewrites[$key]);
            }
        }
        return $productUrlRewrites;
    }

    /**
     * @param int $storeId
     * @param array $ids
     * @return mixed
     */
    protected function _getProductCollection($ids = [], $storeId = 0)
    {
        $productCollection = $this->_productCollectionFactory->create();

        $productCollection->setStore($storeId)
            ->addStoreFilter($storeId)
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('visibility')
            ->addAttributeToSelect('url_key')
            ->addAttributeToSelect('url_path')
            ->addAttributeToSelect('status')
            ->addAttributeToFilter('status', \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED)
            ->setPageSize($this->pageSize);

        if (count($ids) > 0) {
            $productCollection->addIdFilter($ids);
        }

        return $productCollection;
    }
}