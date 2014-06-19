<?php
namespace Crm\Model\PromoObject;

class Video extends PromoObject {

    const TYPE_STR = 'v';

    public function __construct($storage = null) {
        parent::__construct($storage);

        $this->type_id = self::TYPE_STR;
    }

    public function getTypeString() { return self::TYPE_STR;}

    public function getResource() {
        return '/Resources/video/'.$this->id.'.mp4';
    }

    public function getPreview() {
        return '/Resources/video/'.$this->id.'.jpg';
    }
}