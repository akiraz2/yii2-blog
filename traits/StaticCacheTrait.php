<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\traits;

/**
 * Реализует сохранение каких-либо данных в рамках одной сессии
 *
 * Class StaticCacheTrait
 *
 * @package common\traits
 */
trait StaticCacheTrait
{
    /**
     * @var array
     */
    private static $cache = [];

    /**
     * Использование кэша
     *
     * @var bool
     */
    private $useStaticCache = false;

    /**
     * @var string
     */
    private $cacheKey = null;

    /**
     * @return boolean
     */
    public function isUseStaticCache()
    {
        return $this->useStaticCache;
    }

    /**
     * Включает или выключает использование статического сохранения данных
     *
     * @param boolean $useStaticCache
     *
     * @return static
     */
    public function setUseStaticCache($useStaticCache)
    {
        $this->useStaticCache = (bool)$useStaticCache;

        return $this;
    }

    /**
     * Alias of self::setUseStaticCache
     *
     * @param bool|true $value
     *
     * @return static
     */
    public function inCache($value = true)
    {
        return $this->setUseStaticCache($value);
    }

    /**
     * @param $key
     *
     * @return static
     */
    public function unsetCacheValue($key)
    {
        $cacheKey = $this->getGroupCacheKey();

        if (isset(self::$cache[$cacheKey][$key])) {
            unset(self::$cache[$cacheKey][$key]);
        }

        return $this;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return static
     */
    protected function setCacheValue($key, $value)
    {
        $cacheKey = $this->getGroupCacheKey();

        if (!isset(self::$cache[$cacheKey])) {
            self::$cache[$cacheKey] = [];
        }

        self::$cache[$cacheKey][$key] = $value;

        return $this;
    }

    /**
     * @return string
     */
    private function getGroupCacheKey()
    {
        if ($this->cacheKey === null) {
            $propertyName = 'modelClass';
            if (property_exists($this, $propertyName)) {
                $this->cacheKey = $this->$propertyName;
            } else {
                $this->cacheKey = get_called_class();
            }
        }

        return $this->cacheKey;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    protected function getCacheValue($key)
    {
        $cacheKey = $this->getGroupCacheKey();

        if (!isset(self::$cache[$cacheKey])) {
            self::$cache[$cacheKey] = [];
        }

        return isset(self::$cache[$cacheKey][$key]) ? self::$cache[$cacheKey][$key] : null;
    }

    /**
     * @return $this
     */
    protected function clearCache()
    {
        $cacheKey = $this->getGroupCacheKey();

        if (isset(self::$cache[$cacheKey])) {
            unset(self::$cache[$cacheKey]);
        }

        return $this;
    }
}