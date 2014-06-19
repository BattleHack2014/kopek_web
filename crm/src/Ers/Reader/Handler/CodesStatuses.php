<?php
namespace Ers\Reader\Handler;

use Crm\Logic\Client\Code;

use Crm\Model\Statistic\Event\CodeEvent;

use Ers\EventParser;

use Ers\EventParser as EP;

use Ers\UniqueUserEvents;

use Ers\Reader\AbstractReader;

use Ers\Writer\FileWriter;

use Crm\Model\Statistic\Event\LoginEvent;

use Crm\Logic\Client\Auth;
use Crm\Logic\Logic;
use Crm\Logic\Client\Vote;

/**
 * Независимая от предыдущего времени сумма с вариантами
 * Событие не единичное для пользователя
 * За НЕДЕЛЮ и за МЕСЯЦ считаем сумму счетчиков за ДЕНЬ
 */
class CodesStatuses extends AbstractHandler {

    const RIGHT = 'Верные';
    const WRONG = 'Неверные';
    const DUPLICATE = 'Повторные';

    private $_available_statuses = array(
        CodeEvent::STATUS_RIGHT => self::RIGHT,
        CodeEvent::STATUS_WRONG => self::WRONG,
        CodeEvent::STATUS_DUPLICATE => self::DUPLICATE,
    );

    const TABLE = 'stat_report_codes_statuses';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);

        foreach (array_keys($this->_available_statuses) as $dimention)
            $this->_data[$dimention] = 0;
    }

    public function handleRow($row) {
        if ($row[EP::_EVENT] == Code::EVENT_CHECK) {
            foreach (array_keys($this->_available_statuses) as $dimention) {
                // Подходящий статус ?
                if ($row[EP::_PARAMS][1] != $dimention)
                    continue;

                // Накручиваем счетчик
                $this->_data[$dimention]++;
            }
        }
    }

    public function pushData() {
        $this->deleteExistingCounter();

        foreach (array_keys($this->_available_statuses) as $dimention)
            $this->insert($this->_available_statuses[$dimention], $this->_data[$dimention], AbstractReader::PERIOD_DAY);
    }

    public function aggregate($period) {
        if (!in_array($period, array(AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH)))
            return;

        if (!$range = $this->_reader->getRangeByPeriod($period))
            return;

        // Удаляем счетчики для измерений за запрошенный период
        foreach ($this->_available_statuses as $dimention)
            $this->delete($dimention, $period, $range);

        // Устанавливаем счетчик для измерений за запрошенный период
        foreach ($this->_available_statuses as $dimention)
            $this->insert($dimention, $this->getTotalForRange($dimention, AbstractReader::PERIOD_DAY, $range), $period);
    }

    protected function getTable() { return self::TABLE; }
}