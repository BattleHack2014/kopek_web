<?php
namespace Ers\Reader\Handler;

use Crm\Logic\Client\Like;

use Crm\Model\Statistic\Event\LikeEvent;

use Ers\EventParser;

use Ers\EventParser as EP;

use Ers\UniqueUserEvents;

use Ers\Reader\AbstractReader;

use Ers\Writer\FileWriter;

use Crm\Model\Statistic\Event\LoginEvent;

use Crm\Logic\Client\Auth;
use Crm\Logic\Logic;
use Crm\Logic\Client\Vote;

class ContentLikesSocialNetworks extends AbstractHandler {

    const SOCIAL_FB = 'FB';
    const SOCIAL_VK = 'VK';
    const SOCIAL_OK = 'OK';

    private $_available_social = array(
        self::SOCIAL_FB,
        self::SOCIAL_VK,
        self::SOCIAL_OK,
    );

    const TABLE = 'stat_report_content_likes_social_networks';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);

        foreach ($this->_available_social as $dimention)
            $this->_data[$dimention] = 0;
    }

    public function handleRow($row) {
        if ($row[EP::_EVENT] == Like::EVENT_ADD) {
            foreach ($this->_available_social as $dimention) {
                // Подходящая социальная сеть ?
                if ($row[EP::_PARAMS][5] != $dimention)
                    continue;

                // Накручиваем счетчик
                $this->_data[$dimention]++;
            }
        }
    }

    public function pushData() {
        // Удаляем старый счетчик
        $this->deleteExistingCounter();

        // Формируем счетчик для дня
        foreach ($this->_data as $dimention => $counter)
            $this->insert($dimention, $counter, AbstractReader::PERIOD_DAY);
    }

    public function aggregate($period) {
        if (!in_array($period, array(AbstractReader::PERIOD_WEEK, AbstractReader::PERIOD_MONTH)))
            return;

        if (!$range = $this->_reader->getRangeByPeriod($period))
            return;

        foreach ($this->_available_social as $dimention) {
            // Находим сумму за период
            $total = $this->getTotalForRange($dimention, AbstractReader::PERIOD_DAY, $range);

            // Удаляем счетчики за период
            $this->delete($dimention, $period, $range);

            // Устанавливаем счетчик за период
            $this->insert($dimention, $total, $period);
        }
    }


    protected function getTable() { return self::TABLE; }
}