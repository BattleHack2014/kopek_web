<?php
namespace Ers\Reader\Handler;

use Tool\SocialNetwork;

use Ers\EventParser;

use Ers\EventParser as EP;

use Ers\UniqueUserEvents;

use Ers\Reader\AbstractReader;

use Ers\Writer\FileWriter;

use Crm\Model\Statistic\Event\LoginEvent;

use Crm\Logic\Client\Auth;
use Crm\Logic\Logic;
use Crm\Logic\Client\Vote;

class UniqueSocialNetwork extends AbstractHandler {

    private $_available_social = array(
        SocialNetwork::FB,
        SocialNetwork::VK,
        SocialNetwork::OK,
    );

    const TABLE = 'stat_report_unique_social_network';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);

        foreach (array(AbstractReader::PERIOD_DAY, AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH) as $period)
            foreach ($this->_available_social as $dimention)
                $this->_data[$period][$dimention] = array();
    }

    public function handleRow($row) {
        if ($row[EP::_EVENT] == Auth::EVENT_LOGIN) {
            foreach ($this->_available_social as $dimention) {
                // Подходящая социальная сеть ?
                if ($row[EP::_PARAMS][1] != $dimention)
                    continue;

                // Нет смысла продолжать если элемент уже существует
                if (isset($this->_data[AbstractReader::PERIOD_DAY][$dimention][(int)$row[EP::_USER_ID]]))
                    continue;

                // Накручиваем счетчик
                $this->_data[AbstractReader::PERIOD_DAY][$dimention][(int)$row[EP::_USER_ID]] = 1;

                // Проверяем последнее событие
                if ($last_event = UniqueUserEvents::getInstance()->get((int)$row[EP::_USER_ID], Auth::EVENT_LOGIN)) {
                    // Только если совпадает параметр (социальная сеть)
                    if (EventParser::translateExt(1, $last_event[EP::_PARAMS][1]) == $dimention) {
                        // Нужно ли добавить счетчик для недели?
                        if (current($this->_reader->getWeek()) > $last_event[EP::_DATE])
                            $this->_data[AbstractReader::PERIOD_WEEK][$dimention][(int)$row[EP::_USER_ID]] = 1;

                        // Нужно ли добавить счетчик для месяца?
                        if (current($this->_reader->getMonth()) > $last_event[EP::_DATE])
                            $this->_data[AbstractReader::PERIOD_MONTH][$dimention][(int)$row[EP::_USER_ID]] = 1;
                    }
                } else {
                    // Последнего события нет, значит это первое событие за текущие периоды, значит увеличиваем счетчик
                    $this->_data[AbstractReader::PERIOD_WEEK][$dimention][(int)$row[EP::_USER_ID]] = 1;
                    $this->_data[AbstractReader::PERIOD_MONTH][$dimention][(int)$row[EP::_USER_ID]] = 1;
                }

                // Обновляем последнее событие
                UniqueUserEvents::getInstance()->setLast((int)$row[EP::_USER_ID], Auth::EVENT_LOGIN, array(
                    EP::_DATE => $row[EP::_DATE],
                    EP::_PARAMS => EP::shortExt(array( 1 => $dimention))
                ));
            }
        }
    }

    public function pushData() {
        // Удаляем старый счетчик
        $this->deleteExistingCounter();

        foreach (array(AbstractReader::PERIOD_DAY, AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH) as $period)
            foreach ($this->_data[$period] as $dimention => $counter)
                $this->insert($dimention, count($counter), $period);
    }

    public function aggregate($period) {
        if (!in_array($period, array(AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH)))
            return;
        if (!$range = $this->_reader->getRangeByPeriod($period))
            return;

        foreach ($this->_available_social as $dimention) {
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