<?php
namespace Crm\Model\Statistic;

use \Crm\Model\Model;
use \Crm\Model\Statistic\Handler\Handler;
use \Crm\Model\Statistic\Handler\UniqueSex;
use \PDO;
use \Crm\Logic\Logic;
use Symfony\Component\Yaml\Parser;
use Crm\Tool\Config;

class Report extends Model {

    const TABLE_STAT_REPORT = 'stat_report';

    const ERROR_NOT_FOUND_DB = 'Отчет не найден в БД';
    const ERROR_NOT_FOUND_CLASS = 'Обработчик не найден';

    protected $id;
    protected $handler; // строковая, название класса Handler-а
    protected $title;
    protected $campaign_id;
    protected $counter_json;
    protected $header_json;

    /**
     * @var Handler
     */
    private $_handler;

    private $_type;

    public function setHandlerData($from_date, $to_date, $granularity = Handler::GRANULARITY_DAY) {
        $handler_class = '\\Crm\\Model\\Statistic\\Handler\\' . $this->handler;
        if (!class_exists($handler_class))
            throw new \ErrorException(self::ERROR_NOT_FOUND_CLASS);
        $this->_handler = new $handler_class();

        $this->_handler->setData($from_date, $to_date, $granularity);
    }

    public function load() {
        return $this->_handler->loadCounters()->format();
    }

    public function getCustomGroupLabels() {
        return $this->_handler->getCustomGroupLabels();
    }

    protected function _getTable() {
        return self::TABLE_STAT_REPORT;
    }
}