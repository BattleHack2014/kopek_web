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

class AnswersForQuestions extends AbstractHandler {
    const TABLE = 'stat_report_user_answer';

    public function __construct(AbstractReader $reader) {
        parent::__construct($reader);
    }

    public function handleRow($row) {}

    public function handleDbRow($row) {
        if (!isset($this->_data[$row->question_id])) {
            $this->_data[$row->question_id] = array();
        }
        if (!isset($this->_data[$row->question_id][$row->answer_id])) {
            $this->_data[$row->question_id][$row->answer_id] = 0;
        }
        $this->_data[$row->question_id][$row->answer_id]++;
    }

    public function getDbData($startDate, $endDate) {
        $questions = Logic::getDbReader()->executeQuery("
            SELECT answer_id, question_id
            FROM  `quiz_user_answer`
            WHERE
            date(create_date) BETWEEN ? AND ?
            AND campaign_id = ?
        ", array($startDate, $endDate, 3));

        $result = array();
        while( $row = $questions->fetch(\PDO::FETCH_OBJ) ) {
            $result[] = $row;

        }
        return $result;
    }

    public function pushData() {
        foreach ($this->_data as $question_id => $answers) {
            foreach ($answers as $answer_id => $counter) {
                $this->insertOrUpdate($question_id, $answer_id, $counter);
            }
        }
    }

    public function aggregate($period) {

    }

    protected function deleteExistingCounter($question_id, $answer_id) {
        Logic::getDbWriter()->executeQuery("
            DELETE FROM `".$this->getTable()."` WHERE question_id = ? AND answer_id = ?
        ",array($question_id, $answer_id));
    }

    protected function insert($question_id, $answer_id, $counter) {
        Logic::getDbWriter()->executeQuery("
            INSERT IGNORE INTO ".$this->getTable()." (`question_id`, `answer_id`, `counter`)
            VALUES ('".$question_id."', '".$answer_id."', '".$counter."');
        ");
    }

    private function insertOrUpdate ($question_id, $answer_id, $counter)
    {
        Logic::getDbWriter()->executeQuery("
            INSERT IGNORE INTO ".$this->getTable()." (`question_id`, `answer_id`, `counter`)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE counter=counter+?;
        ", array($question_id, $answer_id, $counter, $counter));
    }

    protected function delete($dimention, $period, DateRange $range) {
    }

    protected function getTotalForRange($dimention, $period, DateRange $range) {
        return $this->getTotalForAll($dimention, $period);
    }

    protected function getTotalForAll($dimention, $period) {
    }


    protected function getTable() { return self::TABLE; }
}