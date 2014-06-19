<?php
namespace Ers\Reader\Handler;

use Crm\Model\PromoObject;

use Crm\Logic\Logic;
use Crm\Model\User\User;
use Crm\Logic\Client\Vote;

class WorksRatings extends AbstractHandler {

    const RATING_1 = '1';
    const RATING_2 = '2';
    const RATING_3 = '3';
    const RATING_4 = '4';
    const RATING_5 = '5';

    private $_ratings = array(
        self::RATING_1 => 1,
        self::RATING_2 => 2,
        self::RATING_3 => 3,
        self::RATING_4 => 4,
        self::RATING_5 => 5,
    );

    const TABLE = 'stat_report_works_ratings';

    public function handleRow($row) {}

    public function pushData() {}

    public function aggregate($period) {
    }

    protected function getTable() { return self::TABLE; }
}