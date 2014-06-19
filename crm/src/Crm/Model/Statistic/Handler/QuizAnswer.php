<?php
namespace Crm\Model\Statistic\Handler;

use \Crm\Logic\Logic;
use PDO;

class QuizAnswer extends Handler {

    const TABLE = 'stat_report_user_answer';

    protected $_headers = array(
        'Оценка', 'Количество голосов'
    );

    public function aggregateRow($row) {
        if (!isset($this->_counters[$row->question_id])) {
            $this->_counters[$row->question_id] = array(
                'title' => '',
                'list' => array($this->_headers)
            );
        }
        $this->_counters[$row->question_id]['list'][] = array($row->title, (int)$row->counter);
    }


    public function loadCounters() {
        $stmt = Logic::getDbReader()->prepare('
            SELECT treprort.question_id, quiz_answer.title, treprort.counter
            FROM ' . $this->_getTable() . ' as treprort
            JOIN quiz_answer
                ON treprort.answer_id = quiz_answer.id
        ');
        $stmt->execute();
        while ($row = $stmt->fetch(\PDO::FETCH_OBJ))
            $this->aggregateRow($row);

        return $this;
    }

    public function format() {
        $stmt = Logic::getDbReader()->prepare('SELECT id, title FROM  `quiz_question`;');
        $stmt->execute();
        $questions = array();
        while ($row = $stmt->fetch(\PDO::FETCH_OBJ))
            $questions[$row->id] = $row->title;

        foreach ($this->_counters as $question_id => $question) {
            $question['title'] = $questions[$question_id];
            $this->_output[] = $question;
        }
        return $this->_output;
    }

    protected function _getTable() {
        return self::TABLE;
    }

}