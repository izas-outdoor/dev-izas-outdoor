<?php
/**
 * Created by Metagento.com
 * Date: 4/18/2019
 */

namespace Metagento\BackendUrlRewrite\Service;


abstract class ProcessAbstract extends \Magento\Framework\DataObject
{

    /**
     * @var \Magento\CatalogUrlRewrite\Model\ProductUrlRewriteGenerator
     */
    protected $_productUrlRewriteGenerator;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Action
     */
    protected $_productAction;

    /**
     * @var \Magento\CatalogUrlRewrite\Observer\UrlRewriteHandler
     */
    protected $_urlRewriteHandler;


    /**
     * @var \Magento\CatalogUrlRewrite\Model\CategoryUrlRewriteGenerator
     */
    protected $_categoryUrlRewriteGenerator;

    /**
     * ProcessAbstract constructor.
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param \Magento\Framework\App\State $appState
     * @param \Magento\Catalog\Helper\Category $categoryHelper
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\ActionFactory $productActionFactory
     * @param \Magento\CatalogUrlRewrite\Model\CategoryUrlPathGenerator $categoryUrlPathGenerator
     * @param \Magento\CatalogUrlRewrite\Model\CategoryUrlRewriteGeneratorFactory $categoryUrlRewriteGeneratorFactory
     * @param \Magento\CatalogUrlRewrite\Model\ProductUrlPathGenerator $productUrlPathGenerator
     * @param \Magento\CatalogUrlRewrite\Model\ProductUrlRewriteGeneratorFactory $productUrlRewriteGeneratorFactory
     * @param \Magento\CatalogUrlRewrite\Model\UrlRewriteBunchReplacer $urlRewriteBunchReplacer
     * @param \Magento\CatalogUrlRewrite\Observer\UrlRewriteHandlerFactory $urlRewriteHandlerFactory
     * @param \Magento\CatalogUrlRewrite\Model\Map\DatabaseMapPool $databaseMapPool
     * @param \Magento\UrlRewrite\Model\UrlPersistInterface $urlPersist
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Framework\App\State $appState,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product\ActionFactory $productActionFactory,
        \Magento\CatalogUrlRewrite\Model\CategoryUrlPathGenerator $categoryUrlPathGenerator,
        \Magento\CatalogUrlRewrite\Model\CategoryUrlRewriteGeneratorFactory $categoryUrlRewriteGeneratorFactory,
        \Magento\CatalogUrlRewrite\Model\ProductUrlPathGenerator $productUrlPathGenerator,
        \Magento\CatalogUrlRewrite\Model\ProductUrlRewriteGeneratorFactory $productUrlRewriteGeneratorFactory,
        \Magento\CatalogUrlRewrite\Model\UrlRewriteBunchReplacer $urlRewriteBunchReplacer,
        \Magento\CatalogUrlRewrite\Observer\UrlRewriteHandlerFactory $urlRewriteHandlerFactory,
        \Magento\CatalogUrlRewrite\Model\Map\DatabaseMapPool $databaseMapPool,
        \Magento\UrlRewrite\Model\UrlPersistInterface $urlPersist,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->_resource                    = $resource;
        $this->_appState                    = $appState;
        $this->_categoryHelper              = $categoryHelper;
        $this->_categoryCollectionFactory   = $categoryCollectionFactory;
        $this->_productCollectionFactory    = $productCollectionFactory;
        $this->_productAction               = $productActionFactory->create();
        $this->_categoryUrlPathGenerator    = $categoryUrlPathGenerator;
        $this->_categoryUrlRewriteGenerator = $categoryUrlRewriteGeneratorFactory->create();
        $this->_productUrlPathGenerator     = $productUrlPathGenerator;
        $this->_productUrlRewriteGenerator  = $productUrlRewriteGeneratorFactory->create();
        $this->_urlRewriteBunchReplacer     = $urlRewriteBunchReplacer;
        $this->_urlRewriteHandler           = $urlRewriteHandlerFactory->create();
        $this->_databaseMapPool             = $databaseMapPool;
        $this->_urlPersist                  = $urlPersist;
        $this->_storeManager                = $storeManager;
        $this->_scopeConfig                 = $scopeConfig;
        $this->_messageManager              = $messageManager;
        $this->_dataUrlRewriteClassNames    = [
            \Magento\CatalogUrlRewrite\Model\Map\DataCategoryUrlRewriteDatabaseMap::class,
            \Magento\CatalogUrlRewrite\Model\Map\DataProductUrlRewriteDatabaseMap::class
        ];
    }

    /**
     * @return array
     */
    public function getAllStoreIds()
    {
        $result = [];

        $sql = $this->_resource->getConnection()->select()
            ->from($this->_resource->getTableName('store'), array('store_id', 'code'))
            ->order('store_id', 'ASC');

        $queryResult = $this->_resource->getConnection()->fetchAll($sql);

        foreach ($queryResult as $row) {
            $result[] = $row['store_id'];
        }

        return $result;
    }

    /**
     * @param $idsRange
     * @param string $type
     * @return array
     */
    protected function _generateIdsRangeArray($idsRange, $type = 'product')
    {
        $result = $tmpIds = [];

        list($start, $end) = array_map('intval', explode('-', $idsRange, 2));

        if ($end < $start) {
            $end = $start;
        }

        for ($id = $start; $id <= $end; $id++) {
            $tmpIds[] = $id;
        }

        // get existed Id's from this range in entity DB table
        $tableName = $this->_resource->getTableName('catalog_' . $type . '_entity');
        $ids       = implode(', ', $tmpIds);
        $sql       = "SELECT entity_id FROM {$tableName} WHERE entity_id IN ({$ids}) ORDER BY entity_id";

        $queryResult = $this->_resource->getConnection()->fetchAll($sql);

        foreach ($queryResult as $row) {
            $result[] = (int)$row['entity_id'];
        }


        return $result;
    }


    /**
     * @param array $urlRewrites
     * @param string $type
     */
    protected function _doBunchReplaceUrlRewrites($urlRewrites = array(), $type = 'Category')
    {
        try {
            $this->_urlRewriteBunchReplacer->doBunchReplace($urlRewrites);
        } catch (\Exception $e) {
            $this->addError($e->getMessage());
        }
    }

    /**
     * Reindex
     */
    protected function _reindex()
    {
        shell_exec('php bin/magento indexer:reindex');
        $this->addSuccess(__("Finished Reindexing"));
    }

    /**
     * Clear Cache
     */
    protected function _clearCache()
    {
        shell_exec('php bin/magento cache:clean');
        $this->addSuccess(__("Cleared Cache"));
    }

    /**
     * @param $requestPath
     * @return mixed
     */
    protected function _clearRequestPath($requestPath)
    {
        return str_replace(['//', './'], ['/', '/'], ltrim(ltrim($requestPath, '/'), '.'));
    }

    /**
     *  Get "Use Categories Path for Product URLs" config option value
     * @param null $storeId
     * @return bool
     */
    protected function _getUseCategoriesPathForProductUrlsConfig($storeId = null)
    {
        return (bool)$this->_scopeConfig->getValue(
            'catalog/seo/product_use_categories',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORES,
            $storeId
        );
    }

    /**
     * @param $message
     */
    public function addSuccess($message)
    {
        $this->_messageManager->addSuccessMessage($message);
    }

    /**
     * @param $message
     */
    public function addError($message)
    {
        $this->_messageManager->addErrorMessage($message);
    }
}