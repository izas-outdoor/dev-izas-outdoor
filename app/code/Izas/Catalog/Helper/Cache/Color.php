<?php
namespace Izas\Catalog\Helper\Cache;

use Magento\Framework\App\Helper;
use Magento\Framework\App\Cache;
use Magento\Framework\App\Cache\State;
use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Color
 * @package Izas\Catalog\Helper\Cache
 */
class Color extends AbstractHelper
{
    const CACHE_TAG         = 'PROUDCT_COLORS';
    const CACHE_ID          = 'product_colors';
    const CACHE_LIFETIME    = 86400;

    /**
     * @var Cache $cache
     */
    protected $cache;

    /**
     * @var State $cacheState
     */
    protected $cacheState;

    /**
     * Colors constructor.
     * @param Helper\Context $context
     * @param Cache $cache
     * @param State $cacheState
     */
    public function __construct(
        Helper\Context $context,
        Cache $cache,
        State $cacheState
    ) {
        $this->cache = $cache;
        $this->cacheState = $cacheState;
        parent::__construct($context);
    }

    /**
     * @param array $var
     * @return string
     */
    public function getCacheId($var = [])
    {
        return base64_encode(self::CACHE_ID . '_' . $var);
    }

    /**
     * @param $cacheId
     * @return bool|string
     */
    public function load($cacheId)
    {
        if ($this->cacheState->isEnabled(self::CACHE_ID)) {
            return $this->cache->load($cacheId);
        }

        return false;
    }

    /**
     * @param $data
     * @param $cacheId
     * @param array $tags
     * @return bool
     */
    public function save($data, $cacheId, $tags = [])
    {
        if ($this->cacheState->isEnabled(self::CACHE_ID)) {
            $this->cache->save($data, $cacheId, array_merge([self::CACHE_TAG], $tags), self::CACHE_LIFETIME);
            return true;
        }

        return false;
    }
}