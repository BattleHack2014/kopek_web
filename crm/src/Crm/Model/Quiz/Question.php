<?php
namespace Crm\Model\Quiz;

use Crm\Model\User\User;

use Crm\Logic\Logic;
use \Crm\Model\Model;

class Question extends Model {

    const TABLE = 'quiz_question';

    const STATUS_DRAFT = 'draft';
    const STATUS_ACTIVE = 'active';
    const STATUS_ARCHIVED = 'archived';

    public $id;
    public $campaign_id;
    public $title;
    public $status;

    /**
     * @var AnswerCollection
     */
    private $_answer_collection;

    public function loadRelated($object_name) {
        switch ($object_name) {
            case 'answer':
                $stmt = $this->_storage->getReader()->executeQuery('SELECT `answer_id` FROM `quiz_question_answer` WHERE `question_id` = ?', array($this->id));
                $ids = array();
                foreach ($stmt->fetchAll(\PDO::FETCH_OBJ) as $row)
                    $ids[] = $row->answer_id;

                $this->_answer_collection = new AnswerCollection();
                $this->_answer_collection->loadBy(array(
                    'campaign_id' => $this->campaign_id,
                    'id' => $ids,
                ));
                break;
        }
    }

    public function toArray() {
        $result = parent::toArray();

        if ($this->_answer_collection)
            $result['answer'] = $this->_answer_collection->toArray();

        return $result;
    }

    protected function _getTable() {
        return self::TABLE;
    }
}