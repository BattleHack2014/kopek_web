<?php
namespace Crm\Model\PromoObject;

use Crm\Model\User\UserCollection;
use Crm\Model\CollectionModel;

class PromoObjectCollection extends CollectionModel {

    protected function newModel($type = null) {
        switch ($type) {
            case Photo::TYPE_STR:
                return new Photo();

            case Video::TYPE_STR:
                return new Video();

            case Audio::TYPE_STR:
                return new Audio();

            case Review::TYPE_STR:
                return new Review();
        }

        return new PromoObject();
    }

    public function loadRelated($object_name) {
        if ($this->isEmpty())
            return $this;

        $userIds = array();
        foreach ($this as $object)
            $userIds[] = $object->campaign_user_id;

        $collection = new UserCollection();
        $collection->loadBy(array('id' => $userIds));

        foreach ($this as $object)
            foreach ($collection as $user)
                if ($object->campaign_user_id == $user->id)
                    $object->_user = $user;

        foreach ($this as $key => $object)
            if (!$object->_user)
                unset($this->_objects[$key]);

        return $this;
    }

}