<?php
namespace Crm\Model\User;

use \Crm\Model\Model;

class User extends Model {

    const TABLE = 'promo_campaign_user';

    const ERROR_NOT_FOUND = 'Пользователь не найден';
    const ERROR_NOT_PROMO = 'Не промо пользователь';
    const ERROR_BAN_FOR_VOTE = 'Пользователь временно заблокирован для голосования';

    const GENDER_MEN = 'men';
    const GENDER_WOMEN = 'women';
    const GENDER_UNKNOWN = 'unknown';

    const AVATAR_DEFAULT = 'http://s.imhonet.ru/i/blanks/avatar/empty-40x40.png';

    public $id;
    public $campaign_id;
    public $brand_user_id;
    public $imhonet_user_id;
    public $user_key;
    public $name;
    public $is_active;
    public $contacted_at;
    public $created_at;
    public $gender;
    public $quiz_ready;
    public $avatar;

    /**
     * Является ли юзер валидным промо пользователем
     */
    public function isPromo() {
        return true;
    }

    /**
     * Спам котроль
     */
    public function isBanForVote() {
        return false;
    }

    protected function _getTable() {
        return self::TABLE;
    }

    public function isQuizFinished() {
        return (bool) $this->quiz_ready;
    }
}