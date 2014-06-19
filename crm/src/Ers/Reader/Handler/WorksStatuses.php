<?php
namespace Ers\Reader\Handler;

use Crm\Model\Statistic\Event\ModerationEvent;

use Crm\Logic\Admin\Moderation;

use Crm\Logic\Client\Work;

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
 * За НЕДЕЛЮ и за МЕСЯЦ считаем сумму счетчиков за ДЕНЬ
 *
 * !!!! В этом отчете не учтено, что апрув/реджект одного элемента может происходить несколько раз
 */
class WorksStatuses extends AbstractHandler {

    const SENT = 'Всего отправлено';
    const APPROVED = 'Опубликовано';
    const REJECTED = 'Отклонено';

    private $_available_actions = array(
        Work::EVENT_ADD => self::SENT,
        ModerationEvent::ACTION_APPROVE => self::APPROVED,
        ModerationEvent::ACTION_REJECT => self::REJECTED,
    );

    const TABLE = 'stat_report_works_statuses';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);

        foreach (array_keys($this->_available_actions) as $dimention)
            $this->_data[$dimention] = 0;
    }

    public function handleRow($row) {
        if ($row[EP::_EVENT] == Work::EVENT_ADD) {
            // Накручиваем счетчик
            $this->_data[Work::EVENT_ADD]++;
        }

        if ($row[EP::_EVENT] == ModerationEvent::NAME) {
            foreach (array(ModerationEvent::ACTION_APPROVE, ModerationEvent::ACTION_REJECT) as $dimention) {
                // Подходящий action ?
                if ($row[EP::_PARAMS][1] != $dimention)
                    continue;

                // Накручиваем счетчик
                $this->_data[$dimention]++;
            }
        }
    }

    public function pushData() {
        $this->deleteExistingCounter();

        // Добавляем счетчики за день
        foreach (array_keys($this->_available_actions) as $dimention)
            $this->insert($this->_available_actions[$dimention], $this->_data[$dimention], AbstractReader::PERIOD_DAY);
    }

    public function aggregate($period) {
        if (!in_array($period, array(AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH)))
            return;

        if (!$range = $this->_reader->getRangeByPeriod($period))
            return;

        // Удаляем счетчики для измерений за запрошенный период
        foreach ($this->_available_actions as $dimention)
            $this->delete($dimention, $period, $range);

        // Устанавливаем счетчик для измерений, считая сумму за конкретный период
        foreach ($this->_available_actions as $dimention)
            $this->insert($dimention, $this->getTotalForRange($dimention, AbstractReader::PERIOD_DAY, $range), $period);
    }

    protected function getTable() { return self::TABLE; }
}