<?php
namespace Crm\Model\Goal;

use Crm\Model\Model;

class Goal extends Model {
    const TABLE = 'goal';

    const STATUS_CANCELED       = 'CANCELED';
    const STATUS_IN_PROGRESS    = 'IN_PROGRESS';
    const STATUS_DRAFT          = 'DRAFT';
    const STATUS_VOTING         = 'VOTING';
    const STATUS_WINNER_FRIENDS = 'WINNER_FRIENDS';
    const STATUS_NEW            = 'NEW';
    const STATUS_WINNER_USER    = 'WINNER_USER';

    public $id;
    public $user_id;
    public $title;
    public $description;
    public $amount;
    public $expiration_date;
    public $start_date;
    public $status;
    public $preapproval_key;
    public $is_paid;

    public function loadRelated() {

        return $this;
    }


    public function translateStatus() {
        switch ($this->status) {
            case self::STATUS_CANCELED:       return 'canceled';
            case self::STATUS_IN_PROGRESS:    return 'in progress';
            case self::STATUS_DRAFT:          return 'draft';
            case self::STATUS_VOTING:         return 'voting';
            case self::STATUS_WINNER_FRIENDS: return 'loser';
            case self::STATUS_WINNER_USER:    return 'winner';
        }
    }

    protected function _getTable() {
        return self::TABLE;
    }
} 