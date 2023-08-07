<?php
/**
 * Copyright © 2017 MGT-Commerce GmbH. All rights reserved.
 *
 * @category    Mgt
 * @package     Mgt_Varnish
 * @copyright   Copyright (c) 2017 (https://www.mgt-commerce.com)
 */

namespace Mgt\Varnish\Model\Plugin;

/**
 * Class LayoutPlugin
 */
class LayoutPlugin
{
    const ADMIN_AREA_CODE = 'adminhtml';

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * @var \Magento\PageCache\Model\Config
     */
    protected $storeConfig;

    /**
     * @var \Mgt\Varnish\Model\Cache\Config
     */
    protected $varnishConfig;

    /**
     * @var \Magento\Framework\App\ResponseInterface
     */
    protected $response;

    /**
     * @var \Mgt\Varnish\Model\License
     */
    protected $license;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var int
     */
    protected $cacheLifetime;

    /**
     * @var \Magento\Framework\App\State
     */
    protected $state;

    public function __construct()
    {
        $objectManager = $this->getObjectManager();
        $this->request = $objectManager->get('\Magento\Framework\App\Request\Http');
        $this->response = $objectManager->get('\Magento\Framework\App\ResponseInterface');
        $this->storeConfig = $objectManager->get('\Magento\PageCache\Model\Config');
        $this->varnishConfig = $objectManager->get('\Mgt\Varnish\Model\Cache\Config');
        $this->license = $objectManager->get('\Mgt\Varnish\Model\License');
        $this->state = $objectManager->get('\Magento\Framework\App\State');
        $this->logger = $objectManager->get('\Psr\Log\LoggerInterface');
    }

    /**
     * Retrieve all identities from blocks for further cache invalidation
     *
     * @param \Magento\Framework\View\Layout $subject
     * @param mixed $result
     * @return mixed
     */
    public function afterGetOutput(\Magento\Framework\View\Layout $subject, $result)
    {
        $isCacheable = $this->isCacheable($subject);
        if (true === $isCacheable) {
            $tags = [];
            foreach ($subject->getAllBlocks() as $block) {
                if ($block instanceof \Magento\Framework\DataObject\IdentityInterface) {
                    $isEsiBlock = $block->getTtl() > 0;
                    $isVarnish = $this->storeConfig->getType() == \Magento\PageCache\Model\Config::VARNISH;
                    if ($isVarnish && $isEsiBlock) {
                        continue;
                    }
                    $tags = array_merge($tags, $block->getIdentities());
                }
            }
            $tags = array_unique($tags);
            $tags = array_slice($tags, 0, 500);
            $this->setResponseHeaders($tags);
            $this->saveUrlInformation($tags);
        } else {
            $this->response->setNoCacheHeaders();
            $this->response->setHeader('X-Cache-Lifetime', 0);
        }
        return $result;
    }

    protected function isCacheable(\Magento\Framework\View\Layout $subject)
    {
        $isFullPageCacheEnabled = $this->storeConfig->isEnabled();
        $isVarnishEnabled = $this->varnishConfig->isEnabled();

        if (false === $isFullPageCacheEnabled || false === $isVarnishEnabled) {
            return false;
        }

        $isAdminStore = $this->isAdminStore();
        if (true === $isAdminStore) {
            return false;
        }

        $isMgt = isset($_SERVER['MGT']) && $_SERVER['MGT'] == '1' ? true : false;

        if (false === $isMgt) {
            return false;
        }

        $currentHost = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
        $hasLicense = $this->license->hasLicense($currentHost);

        if (false === $hasLicense) {
            return false;
        }

        $excludedParams = $this->varnishConfig->getExcludedParams();
        foreach ($excludedParams as $param) {
            if ($this->request->getParam(trim($param))) {
                return false;
            }
        }

        $requestString = ltrim($this->request->getRequestString(), '/');
        $requestStringWithoutSlash = rtrim($requestString,'/');
        $requestStringWithSlash = sprintf('%s/', $requestStringWithoutSlash);
        $excludedUrls = $this->varnishConfig->getExcludedUrls();
        foreach ($excludedUrls as $excludedUrl) {
            $excludedUrl = trim($excludedUrl);
            if ($excludedUrl && true === in_array($excludedUrl, [$requestStringWithoutSlash, $requestStringWithSlash])) {
                return false;
            }
        }

        $fullActionName = $this->request->getFullActionName();
        $excludedRoutes = $this->varnishConfig->getExcludedRoutes();
        foreach ($excludedRoutes as $route) {
            $route = trim($route);
            if (!empty($route) && strpos($fullActionName, $route) === 0) {
                return false;
            }
        }

        return true;
    }

    public function setResponseHeaders(array $tags)
    {
        $this->cacheLifetime = $this->varnishConfig->getDefaultCacheLifetime();
        $isDebugModeEnabled = $this->varnishConfig->isDebugModeEnabled();
        $fullActionName = $this->request->getFullActionName();
        $routesCacheLifetime = $this->varnishConfig->getRoutesCacheLifetime();
        if ($routesCacheLifetime && count($routesCacheLifetime)) {
            foreach ($routesCacheLifetime as $routeConfig) {
                $route = isset($routeConfig['field1']) ? trim($routeConfig['field1']) : '';
                $routeCacheLifetime = isset($routeConfig['field2']) ? $routeConfig['field2'] : '';
                if ($route && $fullActionName == $route) {
                    $this->cacheLifetime = $routeCacheLifetime;
                    break;
                }
            }
        }
        if (true === $isDebugModeEnabled) {
            $this->response->setHeader('X-Cache-Debug', 1);
            $this->response->setHeader('X-Magento-Route', $fullActionName);
        }
        $this->response->setHeader('X-Magento-Tags', implode(',', $tags));
        $this->response->setPublicHeaders($this->cacheLifetime);
        $this->response->setHeader('X-Cache-Lifetime', $this->cacheLifetime);
    }

    protected function saveUrlInformation(array $tags)
    {
        $canSaveUrlInformation = $this->canSaveUrlInformation();
        if (true === $canSaveUrlInformation) {
            try {
                $objectManager = $this->getObjectManager();
                $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
                $store = $storeManager->getStore();
                $storeId = $store->getStoreId();
                $storeBaseUri = new \Zend\Uri\Uri($store->getBaseUrl());
                $path = $this->request->getRequestUri();

                if ($storeBaseUri->getPath() != '/') {
                    $path = '/'.substr($path, strlen($storeBaseUri->getPath()));
                }

                $url = $objectManager->create('Mgt\Varnish\Model\Url');
                $url->loadByStoreIdAndPath($storeId, $path);

                if ($url->getId()) {
                    $url->delete();
                    $url = $objectManager->create('Mgt\Varnish\Model\Url');
                }

                $cacheExpiredAt = new \DateTime('now', new \DateTimeZone('UTC'));
                $cacheExpiredAt->add(new \DateInterval(sprintf('PT%sS', $this->cacheLifetime)));
                $cacheExpiredAt = $cacheExpiredAt->format('Y-m-d H:i:s');

                $url->setStoreId($storeId);
                $url->setPath($path);
                $url->setTags($tags);
                $url->setCacheLifetime($this->cacheLifetime);
                $url->setCacheExpiredAt($cacheExpiredAt);
                $url->save();
            } catch (\Exception $e) {
                $this->logger->critical($e);
            }
        }
    }

    protected function canSaveUrlInformation()
    {
        $isAdminStore = $this->isAdminStore();
        if (true === $isAdminStore) {
            return false;
        }

        $isCacheWarmerEnabled = $this->varnishConfig->isCacheWarmerEnabled();
        if (false === $isCacheWarmerEnabled) {
            return false;
        }

        $requestParams = (array)$this->request->getQuery();
        if (count($requestParams)) {
            return false;
        }

        $cacheWarmerRouteFound = false;
        $fullActionName = $this->request->getFullActionName();
        $cacheWarmerRoutes = $this->varnishConfig->getCacheWarmerRoutes();

        foreach ($cacheWarmerRoutes as $cacheWarmerRoute) {
            if ($cacheWarmerRoute == $fullActionName) {
                $cacheWarmerRouteFound = true;
                break;
            }
        }

        if (false === $cacheWarmerRouteFound) {
            return false;
        }

        return true;
    }

    protected function isAdminStore()
    {
        $isAdminStore = $this->state->getAreaCode() == self::ADMIN_AREA_CODE;
        return $isAdminStore;
    }

    protected function getObjectManager()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        return $objectManager;
    }
}
