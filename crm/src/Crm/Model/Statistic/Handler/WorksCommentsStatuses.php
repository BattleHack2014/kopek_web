<?php
namespace Crm\Model\Statistic\Handler;

class WorksCommentsStatuses extends Handler {

    const TABLE = 'stat_report_works_comments_statuses';

    protected $_headers = array(
        'Период (накопительно)',
    );

    public function aggregateRow($row) {
        if (isset($this->_counters[$row->date][$row->{self::DIMENTION}]))
            $this->_counters[$row->date][$row->{self::DIMENTION}] += (int) $row->counter;
        else
           $this->_counters[$row->date][$row->{self::DIMENTION}] = (int) $row->counter;
    }

    public function loadCounters() {
        return $this->loadUsingPeriod();
    }

    public function format() {
        $this->setHeaders();

        $dateFormatter = $this->getDateFormatter();

        foreach ($this->_counters as $date => $counter) {
            if (is_callable($dateFormatter))
                $date = $dateFormatter($date);
            array_push($this->_output, array_values(array_merge(array($date), $counter)));
        }

        return $this->_output;
    }

    protected function _getTable() {
        return self::TABLE;
    }

}