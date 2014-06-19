<?php
namespace Crm\Model\Statistic\Handler;

use Crm\Logic\Logic;

class WorksRatings extends Handler {

    const DIMENTION = 'dimention';
    const TABLE = 'stat_report_works_ratings';

    protected $_headers = array(
        'Оценка', 'Количество'
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
        return array('Среднее');
    }

    protected function _getTable() {
        return self::TABLE;
    }
}