<?php

namespace Tool;

/**
 * Обертка над Memcached для поддержки тегов, описанных в http://www.smira.ru/2008/10/29/web-caching-memcached-5/
 * Использовалась реализация http://dklab.ru/lib/Dklab_Cache/
 */
class MemcachedTag {

    const INDEX_TAG = 'tag';
    const INDEX_DATA = 'data';

    private $_memcached = null;

    public function __construct(\Memcached $memcached) {
        $this->_memcached = $memcached;
    }

    /**
     * Сохраняем значение в Memcached
     * Формируем версии для несуществующих тегов. Существующие теги остаются прежними (!)
     */
    public function set($key, $data, $tags = array(), $ttl = 0)
    {
        // Мультигетом получаем версии тегов, генерируем отсутствующие
        // Нет смысла использовать setMulti так как он не использует протокола Memcached и не является реальным multi set.
        $tags_with_version = array();
        if (is_array($tags)) {
            $existing_tags = $this->_memcached->getMulti($tags);
            foreach ($tags as $tag) {
                if (isset($existing_tags[$tag])) {
                    $version = $existing_tags[$tag];
                } else {
                    $version = $this->_generateNewTagVersion();
                    $this->_memcached->set($tag, $version, $ttl);
                }
                $tags_with_version[$tag] = $version;
            }
        }

        return $this->_memcached->set($key, serialize(array(
            self::INDEX_TAG  => $tags_with_version,
            self::INDEX_DATA => $data
        )), $ttl);
    }

    /**
     * Достаем значение из Memcached
     * Если хотябы один тег несуществует, вернет null
     */
    public function get($key)
    {
        $serialized = $this->_memcached->get($key);
        if ($serialized === false) {
            return null;
        }
        $combined = unserialize($serialized);
        if (!is_array($combined)) {
            return null;
        }

        // Проверяем совпадают ли версии тегов
        if (is_array($combined[self::INDEX_TAG]) && $combined[self::INDEX_TAG]) {
            $existing_tags = $this->_memcached->getMulti(array_keys(($combined[self::INDEX_TAG])));
            foreach ($combined[self::INDEX_TAG] as $tag => $version)
                if (!isset($existing_tags[$tag]) || $existing_tags[$tag] != $version)
                    return null;
        }

        return $combined[self::INDEX_DATA];
    }

    /**
     * Удаление значение в Memcached \ Сброс тега
     */
    public function delete($key) {
        return $this->_memcached->delete($key);
    }

    /**
     * Реальный multi get по протоколу Memcached
     */
    public function getMulti(array $key) {
        return $this->_memcached->getMulti($key);
    }

    public function increment($key) {
        return $this->_memcached->increment($key);
    }

    public function decrement($key) {
        return $this->_memcached->decrement($key);
    }

    /**
     * Generates a new unique identifier for tag version.
     *
     * @return string Globally (hopefully) unique identifier.
     */
    private function _generateNewTagVersion()
    {
        static $counter = 0;
        $counter++;
        return md5(microtime() . getmypid() . uniqid('') . $counter);
    }
}