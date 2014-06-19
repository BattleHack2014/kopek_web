<?php

namespace Crm\Model;

use Crm\Logic\Logic;

class CacheManager {

    public static function loadModelBy(Model $object, array $fields) {
        $cacheKey = $object->getStorageKey();
        if (isset($fields['id']))
            $cacheKey .= $fields['id'];
        else
            $cacheKey .= serialize($fields);

        if ($cached_object = Logic::getMemcachedTag()->get($cacheKey)) {
            return $cached_object;
        }

        if (!$object->loadBy($fields))
            return null;

        // Пока вешаем тег на название класса модели
        Logic::getMemcachedTag()->set($cacheKey, $object, array(get_class($object)));

        return $object;
    }
}