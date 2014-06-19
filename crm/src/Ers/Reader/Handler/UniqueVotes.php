<?php
namespace Ers\Reader\Handler;

use Crm\Model\Feedback\Vote;
use Ers\Reader\AbstractReader;

use Crm\Model\Feedback\Feedback;
use Ers\EventParser as EP;
use Crm\Logic\Logic;
use Crm\Model\User\User;

class UniqueVotes extends AbstractHandler {

    const VOTES_ZERO = '0';
    const VOTES_ONE = '1';
    const VOTES_2_10 = '2-10';
    const VOTES_11_50 = '11-50';
    const VOTES_MORE_50 = '50+';

    private $_votes = array(
        self::VOTES_ZERO => 1,
        self::VOTES_ONE => 2,
        self::VOTES_2_10 => 11,
        self::VOTES_11_50 => 51,
        self::VOTES_MORE_50 => 999999,
    );

    const TABLE = 'stat_report_unique_votes';

    public function handleRow($row) {}

    public function pushData() {}

    public function aggregate($period) {
        $this->deleteExistingCounter($period);

        foreach (array_keys($this->_votes) as $dimention)
            $this->_data[$dimention] = 0;

        $stmt = Logic::getDbReader()->executeQuery("
            SELECT count(id) as users, votes
            FROM (
                SELECT user.id, count(feedback.id) as votes
                FROM ".User::TABLE." AS user
                LEFT JOIN ".Feedback::TABLE_PROMO_CAMPAIGN_USER_FEEDBACK." as feedback
                ON user.id = feedback.campaign_user_id
                WHERE feedback_type_id IS NULL OR feedback_type_id = ".Vote::FEEDBACK_TYPE_ID."
                GROUP BY user.id
            ) AS t_votes
            GROUP BY votes;
        ");

        while( $row = $stmt->fetch(\PDO::FETCH_OBJ) ) {
            foreach ($this->_votes as $dimention => $real_number) {
                if ($row->votes < $real_number) {
                    $this->_data[$dimention] += $row->users;
                    break;
                }
            }
        }

        foreach ($this->_data as $dimention => $counter)
            $this->insert($dimention, $counter, $period);
    }

    protected function getTable() { return self::TABLE; }

}