<?php
namespace Ers\Reader\Handler;

use Crm\Model\Code;

use Ers\Reader\AbstractReader;

use Crm\Logic\Client\Like;
use Crm\Model\Feedback\Feedback;
use Ers\EventParser as EP;
use Crm\Logic\Logic;
use Crm\Model\User\User;

class UniqueCodes extends AbstractHandler {

    const CODES_ZERO = '0';
    const CODES_ONE = '1';
    const CODES_2 = '2';
    const CODES_3_10 = '3-10';
    const CODES_MORE_10 = '10+';

    private $_codes = array(
        self::CODES_ZERO => 1,
        self::CODES_ONE => 2,
        self::CODES_2 => 3,
        self::CODES_3_10 => 11,
        self::CODES_MORE_10 => 999999,
    );

    const TABLE = 'stat_report_unique_codes';

    public function handleRow($row) {}

    public function pushData() {}

    public function aggregate($period) {
        $this->deleteExistingCounter($period);

        foreach (array_keys($this->_codes) as $dimention)
            $this->_data[$dimention] = 0;

        $stmt = Logic::getDbReader()->executeQuery("
            SELECT count(id) as users, codes
            FROM (
                SELECT user.id, count(code.id) as codes
                FROM ".User::TABLE." AS user
                LEFT JOIN ".Code::TABLE." as code
                ON user.id = code.campaign_user_id
                GROUP BY user.id
            ) AS t_codes
            GROUP BY codes;
        ");

        while( $row = $stmt->fetch(\PDO::FETCH_OBJ) ) {
            foreach ($this->_codes as $dimention => $real_number) {
                if ($row->codes < $real_number) {
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