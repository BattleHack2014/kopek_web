<?php
namespace Ers\Reader\Handler;

use Crm\Logic\Logic;
use Crm\Model\User\User;
use Crm\Logic\Client\Vote;

class UniqueAge extends AbstractHandler {

    const AGE_BEFORE_18 = 'До 18';
    const AGE_18_24 = '18-24';
    const AGE_25_34 = '25-34';
    const AGE_35_44 = '35-44';
    const AGE_MORE_45 = '45+';

    private $_age = array(
        self::AGE_BEFORE_18 => 18,
        self::AGE_18_24 => 25,
        self::AGE_25_34 => 35,
        self::AGE_35_44 => 45,
        self::AGE_MORE_45 => 999,
    );

    const TABLE = 'stat_report_unique_age';

    public function handleRow($row) {}

    public function pushData() {}

    public function aggregate($period) {
        $this->deleteExistingCounter($period);

        foreach (array_keys($this->_age) as $dimention)
            $this->_data[$dimention] = 0;

        $stmt = Logic::getDbReader()->executeQuery("
            SELECT age, count(*) AS counter FROM ".User::TABLE." GROUP BY age;
        ");

        while( $row = $stmt->fetch(\PDO::FETCH_OBJ) ) {
            foreach ($this->_age as $dimention => $real_age) {
                if ($row->age < $real_age) {
                    $this->_data[$dimention] += $row->counter;
                    break;
                }
            }
        }

        foreach ($this->_data as $dimention => $counter)
            $this->insert($dimention, $counter, $period);
    }

    protected function getTable() { return self::TABLE; }
}