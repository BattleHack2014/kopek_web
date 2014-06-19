<?php
namespace Crm\Model\Campaign;

use Crm\Model\Storage\DefaultMySqlStorage;
use Crm\Logic\Logic;
use \Crm\Model\Model;

class Campaign extends Model {

    const TABLE = 'promo_campaign';

    public $id;
    public $brand_id;
    public $title;
    public $code;
    public $description;
    public $is_active;
    public $start_date;
    public $end_date;
    public $created_at;

    public function __construct(Storage $storage = null) {
        parent::__construct(new DefaultMySqlStorage());
    }

    public static function clearCache() {
        // Промо проектов не так много, так что просто скидываем весь кеш целиком
        Logic::getMemcachedTag()->delete(__CLASS__);
    }

    public function toArray() {
        return array(
            'id' => $this->id,
            'label' => $this->title,
            'thumbUrl' => '/Resources/photo/' . $this->code .'/campaign_' . $this->id . '.jpg',
        );
    }

    protected function _getTable() {
        return self::TABLE;
    }
}