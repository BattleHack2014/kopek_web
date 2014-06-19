<?php
namespace Crm\Model\Statistic\Handler;

use Crm\Logic\Logic;

class TestResults extends Handler {

    const TABLE = 'stat_report_tests_results';

    protected $_headers = array(
        'Результат', 'Количество участников'
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

    public function getCustomGroupLabels() {
        return array($this->_from_date->format('Y-m-d') . ' - ' . $this->_to_date->format('Y-m-d'));
    }

    protected function _getTable() {
        return self::TABLE;
    }
}