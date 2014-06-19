<?php
namespace Crm\Model\PromoObject;

class Review extends PromoObject {

    const TYPE_STR = 't';

    public function __construct($storage = null) {
        parent::__construct($storage);

        $this->type_id = self::TYPE_STR;
    }

    public function getTypeString() { return self::TYPE_STR;}

    public function getResource() {
        return null;
    }

    public function getPreview() {
        return null;
    }



    public function getRating($id, $sortFields) {
//        $cacheKey = PROJECT.'-'.CAMPAIGN_ID.'-user-rating-';
//        $memcache = \Crm\Logic\Logic::getMemcachedTag();
//        $cached_object = $memcache->get($cacheKey.$id);
//        if ($cached_object) {
//            return $cached_object;
//        }
        $user_rating = null;
        $items = $this->_storage
            ->orderMulti($sortFields)
            ->select(array('id'))
            ->find($this, array('status' => array(\Crm\Model\Moderated::PENDING, \Crm\Model\Moderated::APPROVED)));
        for ($i = 0; $i < count($items); $i++) {
//            $key = $cacheKey . $items[$i]->id;
//            $memcache->set($key, $i+1, array(), 600);
            if ($items[$i]->id == $id) {
                $user_rating = $i+1;
            }
        }
        return $user_rating;
    }


}