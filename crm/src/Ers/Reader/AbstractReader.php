<?php

namespace Ers\Reader;

use Tool\DateRange;
use Ers\UniqueUserEvents;
use Ers\Writer\FileWriter;
use Config\Config;

/**
 * Абстрактный класс записи событий
 */
abstract class AbstractReader {

    const PERIOD_DAY = 'day';
    const PERIOD_WEEK = 'week';
    const PERIOD_MONTH = 'month';

	protected $_handlers = array();

	protected $_config = array();

	public function __construct($config) {
        $this->_config = $config;

        // Инициализируем хендлеры
        if (isset($this->_config['handler'])) {
            foreach ($this->_config['handler'] as $class) {
                $handler_class = '\\Ers\\Reader\\Handler\\' . $class;
                $this->_handlers[] = new $handler_class($this);
            }
        }
	}

	/**
	 * Запуск чтения в зависимости от выбранного периода (день, неделя, месяц)
	 */
	public function doRead() {
        // Читаем лог за текущий день
        $this->read(array($this->getToday()));

        // Сохраняем последние уникальные события пользователей
	    UniqueUserEvents::getInstance()->save();

	    // Подчищаем память если это вдруг не сделает сборщик
	    unset($this->_handlers);
	}

	/**
	 * Реализация процесса и источника чтения лежит на наследниках
	 */
	protected abstract function read($date_range);

	/**
	 * Возвращает текущий timestamp
	 * Зависит от параметра date в конфигурации, т.к. с его помощью можно изменить текущий timestamp
	 */
	protected function getStartTime() {
	    if (isset($this->_config['date']) && $this->_config['date'] != 'current')
	        return strtotime($this->_config['date']);

	    return time();
	}

	/**
	 * Возращает текущую дату
	 * Зависит от параметра date в конфигурации, т.к. с его помощью можно изменить текущую дату
	 */
	public function getToday() {
	    return date("Y-m-d",$this->getStartTime());
	}

	/**
	 * Возвращает список дат текущей недели
	 */
	public function getWeek() {
	    $end = new \DateTime(date("Y-m-d", $this->getStartTime()));
	    $end->modify('+1 day');

	    $start = new \DateTime(date("Y-m-d", $this->getStartTime()));
	    $difference = $start->format('N') - 1;
	    $start->modify('-'.$difference.' day');

	    $result = array();
	    foreach(new \DatePeriod($start, new \DateInterval('P1D') ,$end) as $date)
	        $result[] = $date->format('Y-m-d');

	    reset($result);

	    return $result;
	}

	/**
	 * Возвращает список дат текущего месяца
	 */
	public function getMonth() {
	    $end = new \DateTime(date("Y-m-d", $this->getStartTime()));
	    $end->modify('+1 day');

	    $start = new \DateTime(date("Y-m-01", $this->getStartTime()));

	    $result = array();
	    foreach(new \DatePeriod($start, new \DateInterval('P1D') ,$end) as $date)
	        $result[] = $date->format('Y-m-d');

	    reset($result);

	    return $result;
	}

	/**
	 * @param unknown $period
	 * @return \Tool\DateRange|NULL
	 */
	public function getRangeByPeriod($period) {
	    if ($period == AbstractReader::PERIOD_WEEK)
	        return new DateRange($this->getWeek());

	    if ($period == AbstractReader::PERIOD_MONTH)
	        return new DateRange($this->getMonth());

        return null;
	}
}