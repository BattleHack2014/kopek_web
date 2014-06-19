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

class WorksCommentsStatuses extends AbstractHandler {

    const SENT = 'Всего отправлено';
    const ACCEPTED = 'Принято';
    const PENDING = 'Ожидает';

    private $_available_statuses = array(
        self::SENT,
        self::ACCEPTED,
        self::PENDING,
    );

    const TABLE = 'stat_report_works_comments_statuses';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);

        foreach (array(AbstractReader::PERIOD_DAY, AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH) as $period)
            foreach ($this->_available_social as $dimention)
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