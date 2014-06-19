<?php
namespace Ers\Reader\Handler;

use Crm\Model\Statistic\Event\RejectEvent;

use Crm\Logic\Client\Reject;

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
 * Один пользователь может только по одному разу отказаться от рассылки или от участия, регулируется бизнес логикой
 * За НЕДЕЛЮ и за МЕСЯЦ считаем сумму счетчиков за ДЕНЬ
 */
class RejectionRequests extends AbstractHandler {

    const REJECT_SUBSCRIPTION = 'Отказов от рассылок';
    const REJECT_PARTICIPATION = 'Отказов от участия';

    private $_available_rejects = array(
        RejectEvent::REJECT_SUBSCRIPTION => self::REJECT_SUBSCRIPTION,
        RejectEvent::REJECT_PARTICIPATION => self::REJECT_PARTICIPATION,
    );

    const TABLE = 'stat_report_rejection_requests';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);

        foreach (array_keys($this->_available_rejects) as $dimention)
            $this->_data[$dimention] = array();
    }

    public function handleRow($row) {
        if ($row[EP::_EVENT] == Reject::EVENT_REJECT) {
            foreach (array_keys($this->_available_rejects) as $dimention) {
                // Подходящий тип отказа ?
                if ($row[EP::_PARAMS][1] != $dimention)
                    continue;

                // Нет смысла продолжать если элемент уже существует
                if (isset($this->_data[$dimention][(int)$row[EP::_USER_ID]]))
                    continue;

                // Накручиваем счетчик
                $this->_data[$dimention][(int)$row[EP::_USER_ID]] = 1;
            }
        }
    }

    public function pushData() {
        $this->deleteExistingCounter();

        foreach (array_keys($this->_available_rejects) as $dimention) {
            if (!$this->_data[$dimention]) {
                $this->insert($this->_available_rejects[$dimention], 0, AbstractReader::PERIOD_DAY);
            } else {
                $this->insert($this->_available_rejects[$dimention], count($this->_data[$dimention]), AbstractReader::PERIOD_DAY);
            }
        }
    }

    public function aggregate($period) {
        if (!in_array($period, array(AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH)))
            return;

        if (!$range = $this->_reader->getRangeByPeriod($period))
            return;

        // Удаляем счетчики для измерений за запрошенный период
        foreach ($this->_available_rejects as $dimention)
            $this->delete($dimention, $period, $range);

        // Устанавливаем счетчик для измерений за запрошенный период
        foreach ($this->_available_rejects as $dimention)
            $this->insert($dimention, $this->getTotalForRange($dimention, AbstractReader::PERIOD_DAY, $range), $period);
    }

    protected function getTable() { return self::TABLE; }
}