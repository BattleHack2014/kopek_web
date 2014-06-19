<?php
namespace Crm\Model\Statistic\Handler;

use Crm\Logic\Logic;

class UniqueCodes extends Handler {

    const TABLE = 'stat_report_unique_codes';

    protected $_headers = array(
        'Количество верных кодов', 'Количество участников'
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