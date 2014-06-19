<?php
namespace Ers\Reader\Handler;

use Crm\Logic\Logic;
use Crm\Model\User\User;
use Crm\Logic\Client\Vote;

class UniqueSex extends AbstractHandler {

    const SEX_MEN = 'Мужчины';
    const SEX_WOMEN = 'Женщины';
    const SEX_UNKNOWN = 'Неизвестно';

    private $_translate = array(
        User::GENDER_MEN => self::SEX_MEN,
        User::GENDER_WOMEN => self::SEX_WOMEN,
        User::GENDER_UNKNOWN => self::SEX_UNKNOWN,
    );

    const TABLE = 'stat_report_unique_sex';

    public function handleRow($row) {}

    public function pushData() {}

    public function aggregate($period) {
        $this->deleteExistingCounter($period);

        $stmt = Logic::getDbReader()->executeQuery("
            SELECT gender, count(*) AS counter FROM promo_campaign_user GROUP BY gender;
        ");

        while( $row = $stmt->fetch(\PDO::FETCH_OBJ) )
            $this->insert($this->_translate[$row->gender], $row->counter, $period);
    }

    protected function getTable() { return self::TABLE; }
}