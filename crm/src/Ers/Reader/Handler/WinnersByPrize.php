<?php
namespace Ers\Reader\Handler;

use Ers\EventParser;

use Ers\EventParser as EP;

use Ers\UniqueUserEvents;

use Ers\Reader\AbstractReader;

use Ers\Writer\FileWriter;

use Crm\Model\Statistic\Event\LoginEvent;

use Crm\Logic\Client\Auth;
use Crm\Logic\Logic;
use Crm\Logic\Client\Vote;

class WinnersByPrize extends AbstractHandler {

    const TIKETS = '2 билета';
    const BOOK = 'Книга';
    const DVD = 'DVD';

    private $_available_prize = array(
        self::TIKETS,
        self::BOOK,
        self::DVD,
    );

    const TABLE = 'stat_report_winners_by_prize';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);

        foreach (array(AbstractReader::PERIOD_DAY, AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH) as $period)
            foreach ($this->_available_prize as $dimention)
                $this->_data[$period][$dimention] = array();
    }

    public function handleRow($row) {
    }

    public function pushData() {
    }

    public function aggregate($period) {
    }

    protected function getTable() { return self::TABLE; }
}