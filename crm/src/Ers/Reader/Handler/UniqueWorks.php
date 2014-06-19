<?php
namespace Ers\Reader\Handler;

use Crm\Model\PromoObject\PromoObject;

use Crm\Logic\Logic;
use Crm\Model\User\User;
use Crm\Logic\Client\Vote;

class UniqueWorks extends AbstractHandler {

    const WORKS_ZERO = '0';
    const WORKS_ONE = '1';
    const WORKS_2_5 = '2-5';
    const WORKS_6_10 = '6-10';
    const WORKS_MORE_10 = '10+';

    private $_works = array(
        self::WORKS_ZERO => 1,
        self::WORKS_ONE => 2,
        self::WORKS_2_5 => 6,
        self::WORKS_6_10 => 11,
        self::WORKS_MORE_10 => 999,
    );

    const TABLE = 'stat_report_unique_works';

    public function handleRow($row) {}

    public function pushData() {}

    public function aggregate($period) {
        $this->deleteExistingCounter($period);

        foreach (array_keys($this->_works) as $dimention)
            $this->_data[$dimention] = 0;

        $stmt = Logic::getDbReader()->executeQuery("
            SELECT count(id) as users, objects
            FROM (
                SELECT user.id, count(object.id) as objects
                FROM ".User::TABLE." AS user
                LEFT JOIN ".PromoObject::TABLE_PROMO_CAMPAIGN_USER_OBJECT." as object
                ON user.id = object.campaign_user_id
                GROUP BY user.id
            ) AS t_objects
            GROUP BY objects;
        ");

        while( $row = $stmt->fetch(\PDO::FETCH_OBJ) ) {
            foreach ($this->_works as $dimention => $real_number) {
                if ($row->objects < $real_number) {
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