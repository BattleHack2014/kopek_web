<?php
namespace Crm\Model\PromoObject;

class Audio extends PromoObject {

    const TYPE_STR = 'a';

    public function __construct($storage = null) {
        parent::__construct($storage);

        $this->type_id = self::TYPE_STR;
    }

    public function getTypeString() { return self::TYPE_STR;}

    public function getResource() {
        return '/Resources/audio/'.$this->id.'.mp3';
    }

    public function getPreview() {
        return '/Resources/audio/preview.jpg';
    }
}