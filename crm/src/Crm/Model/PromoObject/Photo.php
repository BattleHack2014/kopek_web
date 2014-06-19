<?php
namespace Crm\Model\PromoObject;

class Photo extends PromoObject {

    const TYPE_STR = 'p';

    public function __construct($storage = null) {
        parent::__construct($storage);

        $this->type_id = self::TYPE_STR;
    }

    public function getTypeString() { return self::TYPE_STR;}

    public function getResource() {
        return '/Resources/photo/' . $this->id . '.jpg';
    }

    public function getPreview() {
        return '/Resources/photo/' . $this->id . '.jpg';
    }
}