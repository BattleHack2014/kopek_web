<?php
namespace Crm\Model\Statistic\Handler;

use Crm\Logic\Logic;

class UniqueVotes extends Handler {

    const DIMENTION = 'dimention';
    const TABLE = 'stat_report_unique_votes';

    protected $_headers = array(
        'Количество отданных голосов', 'Количество участников'
    );

    public function aggregateRow($row) {
       $this->_counters[$row->{self::DIMENTION}] = (int) $row->counter;
    }

    public function loadCounters() {
        return $this->loadUsingToDate();
    }

    public function format() {
        $this->setHeaders();
        foreach ($this->_counters as $title => $counter) {
            array_push($this->_output, array($title, $counter));
        }

        return $this->_output;
    }


    protected function _getTable() {
        return self::TABLE;
    }
}