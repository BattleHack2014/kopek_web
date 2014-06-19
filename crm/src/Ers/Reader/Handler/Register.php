<?php
namespace Ers\Reader\Handler;

use Ers\UniqueUserEvents;

use Ers\Reader\AbstractReader;
use Crm\Logic\Logic;
use Ers\EventParser as EP;

class Register extends AbstractHandler {

    const TABLE = 'stat_report_register';

    const TIME_NEW = 'Новые';
    const TIME_TOTAL = 'Всего';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);

        foreach ($this->_available_periods as $period)
            $this->_data[$period] = array();
    }

    public function handleRow($row) {
        if ($row[EP::_EVENT] == \Crm\Logic\Client\Register::EVENT_REGISTER) {
            // Нет смысла продолжать если элемент уже существует
            if (isset($this->_data[AbstractReader::PERIOD_DAY][(int)$row[EP::_USER_ID]]))
                return;

            // Накручиваем счетчик
            $this->_data[AbstractReader::PERIOD_DAY][(int)$row[EP::_USER_ID]] = 1;

            // Проверяем последнее событие
            if ($last_event = UniqueUserEvents::getInstance()->get((int)$row[EP::_USER_ID], \Crm\Logic\Client\Register::EVENT_REGISTER)) {
                // Нужно ли добавить счетчик для недели?
                if (current($this->_reader->getWeek()) > $last_event[EP::_DATE])
                    $this->_data[AbstractReader::PERIOD_WEEK][(int)$row[EP::_USER_ID]] = 1;

                // Нужно ли добавить счетчик для месяца?
                if (current($this->_reader->getMonth()) > $last_event[EP::_DATE])
                    $this->_data[AbstractReader::PERIOD_MONTH][(int)$row[EP::_USER_ID]] = 1;

            } else {
                // Последнего события нет, значит это первое событие за текущие периоды, значит увеличиваем счетчик
                $this->_data[AbstractReader::PERIOD_WEEK][(int)$row[EP::_USER_ID]] = 1;
                $this->_data[AbstractReader::PERIOD_MONTH][(int)$row[EP::_USER_ID]] = 1;
            }

            // Обновляем последнее событие
            UniqueUserEvents::getInstance()->setLast((int)$row[EP::_USER_ID], \Crm\Logic\Client\Register::EVENT_REGISTER, array(
                EP::_DATE => $row[EP::_DATE]
            ));
        }
    }

    public function pushData() {
        $this->deleteExistingCounter();

        foreach ($this->_available_periods as $period) {
            if (!$this->_data[$period]) {
                $this->insert(self::TIME_NEW, 0, $period);
            } else {
                $this->insert(self::TIME_NEW, count($this->_data[$period]), $period);
            }

            // Total пишем только для дня, для остальных можно посчитать во время агрегации
            if ($period == AbstractReader::PERIOD_DAY)
                $this->insert(self::TIME_TOTAL, $this->getTotalForAll(self::TIME_NEW, $period), $period);
        }
    }

    public function aggregate($period) {
        if (!in_array($period, array(AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH)))
            return;

        if (!$range = $this->_reader->getRangeByPeriod($period))
            return;

        // Находим сумму для Новых
        $total = $this->getTotalForRange(self::TIME_NEW, $period, $range);

        // Удаляем счетчики для Новых
        $this->delete(self::TIME_NEW, $period, $range);

        // Устанавливаем счетчик для Новых
        $this->insert(self::TIME_NEW, $total, $period);

        $this->insert(self::TIME_TOTAL, $this->getTotalForAll(self::TIME_NEW, $period), $period);
    }

    protected function getTable() { return self::TABLE; }
}