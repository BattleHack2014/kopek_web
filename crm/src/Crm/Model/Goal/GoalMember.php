<?php
namespace Crm\Model\Goal;


class GoalMember extends Model {
    const TABLE = 'goal_member';

    const VOTE_YES = 'YES';
    const VOTE_NO = 'NO';
    const VOTE_UNKNOWN = 'UNKNOWN';

    const BID_YES = 'YES';
    const BID_NO = 'NO';
    const BID_UNKNOWN = 'UNKNOWN';

    public $id;
    public $user_id;
    public $goal_id;
    public $amount;
    public $date;
    public $preapproval_key;
    public $vote;//enum('YES','NO','UNKNOWN')
    public $bid;//enum('YES','NO','UNKNOWN')

    protected function _getTable() {
        return self::TABLE;
    }
} 