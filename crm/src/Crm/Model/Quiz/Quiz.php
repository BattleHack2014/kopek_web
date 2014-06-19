<?php
namespace Crm\Model\Quiz;

use Crm\Model\User\User;

use Crm\Logic\Logic;
use \Crm\Model\Model;

class Quiz extends Model {

    const TABLE = 'quiz';

    const STATUS_DRAFT = 'draft';
    const STATUS_ACTIVE = 'active';
    const STATUS_ARCHIVED = 'archived';

    public $id;
    public $campaign_id;
    public $title;
    public $start;
    public $end;
    public $status;

    /**
     * @var QuestionCollection
     */
    private $_question_collection;

    public function loadRelated($object_name) {
        switch ($object_name) {
            case 'question':
                $stmt = $this->_storage->getReader()->executeQuery('SELECT question_id FROM `quiz_quiz_question` WHERE quiz_id = ?', array($this->id));
                $ids = array();
                foreach ($stmt->fetchAll(\PDO::FETCH_OBJ) as $row)
                    $ids[] = $row->question_id;

                $this->_question_collection = new QuestionCollection();
                $this->_question_collection->loadBy(array(
                    'campaign_id' => $this->campaign_id,
                    'id' => $ids,
                ));

                // Загружаем ответы
                $this->_question_collection->loadRelated('answer');
                break;
        }
    }

    public function toArray() {
        $result = parent::toArray();

        if ($this->_question_collection)
            $result['question'] = $this->_question_collection->toArray();

        return $result;
    }

    protected function _getTable() {
        return self::TABLE;
    }
}