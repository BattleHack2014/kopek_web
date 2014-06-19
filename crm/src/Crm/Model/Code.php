<?php
namespace Crm\Model;

use Crm\Model\User\User;

use Crm\Logic\Logic;
use \Crm\Model\Model;

class Code extends Model {

    const TABLE = 'promo_campaign_code';

    const STATUS_INACTIVE = 'pending';
    const STATUS_ACTIVE = 'active';

    public $id;
    public $code;
    public $campaign_user_id;
    public $status;
    public $updated_at;

    public function loadRelated() {
        $user = new User();
        if ($this->campaign_user_id === null) {
            $user->name = ' - ';
            $this->_user = $user;
            return $this;
        }

        if (!$user->loadBy(array('id' => $this->campaign_user_id)))
            return false;

        $this->_user = $user;
        return $this;
    }

    public function isActivated() {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function translateStatus() {
        switch ($this->status) {
            case self::STATUS_ACTIVE: return 'использован';
            case self::STATUS_INACTIVE: return 'не использован';
        }
    }

    protected function _getTable() {
        return self::TABLE;
    }
}