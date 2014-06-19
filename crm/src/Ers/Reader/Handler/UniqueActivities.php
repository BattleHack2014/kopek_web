<?php
namespace Ers\Reader\Handler;

use Crm\Logic\Client\Like;
use Crm\Logic\Client\Friend;
use Crm\Logic\Client\Comment;
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

class UniqueActivities extends AbstractHandler {

    const WORK_ADD = 'Отправили работу';
    const VOTE_ADD = 'Проголосовали';
    const COMMENT_ADD = 'Комментировали';
    const FRIEND_ADD = 'Пригласили друга';
    const LIKE_ADD = 'Лайкали';

    private $_activities = array(
        Work::EVENT_ADD => self::WORK_ADD,
        Vote::EVENT_ADD => self::VOTE_ADD,
        Comment::EVENT_ADD => self::COMMENT_ADD,
        Friend::EVENT_ADD => self::FRIEND_ADD,
        Like::EVENT_ADD => self::LIKE_ADD,
    );

    const TABLE = 'stat_report_unique_activities';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);

        foreach ($this->_available_periods as $period)
            foreach (array_keys($this->_activities) as $activity)
                $this->_data[$period][$activity] = array();
    }

    public function handleRow($row) {
        if (in_array($row[EP::_EVENT], array_keys($this->_activities))) {
            // Нет смысла продолжать если элемент уже существует
            if (isset($this->_data[AbstractReader::PERIOD_DAY][$row[EP::_EVENT]][(int)$row[EP::_USER_ID]]))
                return;

            // Накручиваем счетчик
            $this->_data[AbstractReader::PERIOD_DAY][$row[EP::_EVENT]][(int)$row[EP::_USER_ID]] = 1;

            // Проверяем последнее событие
            if ($last_event = UniqueUserEvents::getInstance()->get((int)$row[EP::_USER_ID], $row[EP::_EVENT])) {
                // Нужно ли добавить счетчик для недели?
                if (current($this->_reader->getWeek()) > $last_event[EP::_DATE])
                    $this->_data[AbstractReader::PERIOD_WEEK][$row[EP::_EVENT]][(int)$row[EP::_USER_ID]] = 1;

                // Нужно ли добавить счетчик для месяца?
                if (current($this->_reader->getMonth()) > $last_event[EP::_DATE])
                    $this->_data[AbstractReader::PERIOD_MONTH][$row[EP::_EVENT]][(int)$row[EP::_USER_ID]] = 1;
            } else {
                // Последнего события нет, значит это первое событие за текущие периоды, значит увеличиваем счетчик
                $this->_data[AbstractReader::PERIOD_WEEK][$row[EP::_EVENT]][(int)$row[EP::_USER_ID]] = 1;
                $this->_data[AbstractReader::PERIOD_MONTH][$row[EP::_EVENT]][(int)$row[EP::_USER_ID]] = 1;
            }

            // Обновляем последнее событие
            UniqueUserEvents::getInstance()->setLast((int)$row[EP::_USER_ID], $row[EP::_EVENT], array(
                EP::_DATE => $row[EP::_DATE]
            ));
        }
    }

    public function pushData() {
        $this->deleteExistingCounter();

        foreach (array(AbstractReader::PERIOD_DAY, AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH) as $period)
            foreach ($this->_data[$period] as $event => $counter)
                $this->insert($this->_activities[$event], count($counter), $period);
    }

    public function aggregate($period) {
        if (!in_array($period, array(AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH)))
            return;
        if (!$range = $this->_reader->getRangeByPeriod($period))
            return;

        foreach ($this->_activities as $dimention) {
            // Находим сумму за период
            $total = $this->getTotalForRange($dimention, $period, $range);

            // Удаляем счетчики за период
            $this->delete($dimention, $period, $range);

            // Устанавливаем счетчик за период
            $this->insert($dimention, $total, $period);
        }
    }

    protected function getTable() { return self::TABLE; }
}