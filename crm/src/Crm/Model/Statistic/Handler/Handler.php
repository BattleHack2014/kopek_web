<?php
namespace Crm\Model\Statistic\Handler;

use \Crm\Logic\Logic;
use PDO;

abstract class Handler {

    const DIMENTION = 'dimention';

    const GRANULARITY_DAY = 'day';
    const GRANULARITY_WEEK = 'week';
    const GRANULARITY_MONTH = 'month';

    protected $_counters = array();

    protected $_from_date = null;
    protected $_to_date = null;

    protected $_output = array();

    protected $_granularity = null;

    protected $_headers = array();

    public function setData($from_date, $to_date, $granularity = self::GRANULARITY_DAY) {
        $this->_from_date = new \DateTime( $from_date );
        $this->_to_date = new \DateTime( $to_date );

        $this->_granularity = $granularity;
    }

    /**
     * Подгружааем счетчики из БД
     *
     * @return \Crm\Model\Statistic\Handler\Handler
     */
    public abstract function loadCounters();

    protected function loadUsingPeriod() {
        $stmt = Logic::getDbReader()->prepare('
            SELECT *
            FROM ' . $this->_getTable() . '
            WHERE date BETWEEN ? AND ? AND period = ?
        ');

        // Если это текущий день, необходимо сместить даты
        if (date('d') == $this->_to_date->format('N')) {
            switch ($this->_granularity) {
                case self::GRANULARITY_WEEK:
                    // Смещаем дату к предыдущему воскресенью, так как позже никаких цифр быть не должно
                    $difference = $this->_to_date->format('N');
                    $this->_to_date->modify('-'.$difference.' day');
                    break;
                case self::GRANULARITY_MONTH:
                    // Смещаем дату к 31-му числу предыдущего месяца, так как позже никаких цифр быть не должно
                    $this->_to_date = new \DateTime($this->_to_date->format("Y-m-01"));
                    $this->_to_date->modify('-1 day');
                    break;
            }
        }
        $stmt->bindValue(1, $this->_from_date->format('Y-m-d'));
        $stmt->bindValue(2, $this->_to_date->format('Y-m-d'));
        $stmt->bindValue(3, $this->_granularity);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $this->aggregateRow($row);
        }

        return $this;
    }

    protected function loadUsingToDate() {
        $stmt = Logic::getDbReader()->prepare('
            SELECT *
            FROM ' . $this->_getTable() . '
            WHERE date = ? AND period = ?
        ');
        $stmt->bindValue(1, $this->_to_date->format('Y-m-d'));
        $stmt->bindValue(2, $this->_granularity);
        $stmt->execute();
        while ($row = $stmt->fetch(\PDO::FETCH_OBJ))
            $this->aggregateRow($row);

        return $this;
    }

    /**
     * Собираем вместе готовый отчет
     */
    public abstract function format();

    /**
     * Заголовки таблицы (столбцов или строк)
     */
    protected function setHeaders() {
        // Вычислияем заголовки в отчете с группировкой
        if ($this->_counters && is_array($line = current($this->_counters))) {
            // Ключи строки содержат названия заголовков столбцов
            $this->_headers = array_merge($this->_headers, array_keys($line));
        }
        array_push($this->_output, $this->_headers);
        return $this;
    }

    /**
     * Функция форматирования промежутка во времени для каждой строки таблицы
     *
     * @return \Closure
     */
    protected function getDateFormatter() {
        switch($this->_granularity) {
            case self::GRANULARITY_WEEK:
                return function ($date) {
                    $end = new \DateTime($date);
                    $end->modify(' -6 day');
                    return $end->format('Y-m-d') . ' - ' . $date;
                };

            case self::GRANULARITY_MONTH:
                return function ($date) {
                    $end = new \DateTime($date);
                    return $end->format('Y-m') . '-01 - ' . $date;
                };
        }
        return null;
    }

    public function getCustomGroupLabels() {}

    /**
     * Формула агрегации отдельных счетчиков полученных из БД
     */
    protected abstract function aggregateRow($row);

    protected abstract function _getTable();
}