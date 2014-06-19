<?php

namespace Ers\Reader\Handler;

use Tool\DateRange;

use Crm\Logic\Logic;

use Ers\Reader\AbstractReader;

use Symfony\Component\Console\Helper\HelperSet;

/**
 * Абстрактный класс записи событий
 */
abstract class AbstractHandler {

    protected $_data = array();

    protected $_available_periods = array(
        AbstractReader::PERIOD_DAY,
        AbstractReader::PERIOD_WEEK,
        AbstractReader::PERIOD_MONTH,
    );

    /**
     * @var AbstractReader
     */
    protected $_reader = null;

    public function __construct(AbstractReader $reader) {
        $this->_reader = $reader;
    }

    /**
     * Стратегия работы с файловым хранилищем
     * Обработка одной строки лога (агрегация)
     */
    protected abstract function handleRow($row);

	/**
	 * Стратегия работы с файловым хранилищем
	 * Загрузка результатов агрегации в БД
	 */
	protected abstract function pushData();

	/**
	 * Подсчет сумм/очистка неактуальных счетчиков
	 * Метод актуален для периодов неделя/месяц
	 */
	protected abstract function aggregate($period);

	protected abstract function getTable();

	protected function deleteExistingCounter($period = null) {
	    Logic::getDbWriter()->executeQuery("
            DELETE FROM `".$this->getTable()."` WHERE date = ? ". (($period) ? " AND period = '".$period."'" : "") . "
        ",array($this->_reader->getToday()));
	}

	protected function insert($dimention, $counter, $period) {
	    Logic::getDbWriter()->executeQuery("
            INSERT IGNORE INTO ".$this->getTable()." (`date`, `dimention`, `counter`, `period`)
            VALUES ('".$this->_reader->getToday()."', '".$dimention."', '".$counter."', '" . $period . "');
        ");
	}

	protected function delete($dimention, $period, DateRange $range) {
        Logic::getDbWriter()->executeQuery("
            DELETE
            FROM ".$this->getTable()."
            WHERE dimention = ? AND period = ? AND date BETWEEN ? AND ?;
        ", array($dimention, $period, $range->start, $range->end));
	}

	protected function getTotalForRange($dimention, $period, DateRange $range) {
	    $stmt = Logic::getDbReader()->executeQuery("
            SELECT SUM(counter) as total
            FROM ".$this->getTable()."
            WHERE dimention = ? AND period = ? AND date BETWEEN ? AND ?
            GROUP BY period;
        ", array($dimention, $period, $range->start, $range->end));
	    if ($row = $stmt->fetch(\PDO::FETCH_OBJ))
	        return $row->total;

        return 0;
	}

	protected function getTotalForAll($dimention, $period) {
	    $stmt = Logic::getDbReader()->executeQuery("
            SELECT SUM(counter) as total
            FROM ".$this->getTable()."
            WHERE dimention = ? AND period = ? AND date <= ?
            GROUP BY period;
        ", array($dimention, $period, $this->_reader->getToday()));
	    if ($row = $stmt->fetch(\PDO::FETCH_OBJ))
	        return $row->total;
	    return 0;
	}
}