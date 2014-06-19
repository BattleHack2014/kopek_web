<?php
namespace Crm\Model\Statistic\Handler;

use Crm\Logic\Logic;

class UniqueSex extends Handler {

    const TABLE = 'stat_report_unique_sex';

    protected $_headers = array(
        'Пол', 'Количество'
    );

    public function aggregateRow($row) {
       $this->_counters[$row->{self::DIMENTION}] = (int) $row->counter;
    }

    /**
     * Подгружааем счетчики из БД
     *
     * @return \Crm\Model\Statistic\Handler\Handler
     */
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