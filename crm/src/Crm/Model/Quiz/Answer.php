<?php
namespace Crm\Model\Quiz;

use Crm\Model\User\User;

use Crm\Logic\Logic;
use \Crm\Model\Model;

class Answer extends Model {

    const TABLE = 'quiz_answer';

    const STATUS_DRAFT = 'draft';
    const STATUS_ACTIVE = 'active';
    const STATUS_ARCHIVED = 'archived';

    public $id;
    public $campaign_id;
    public $title;
    public $status;

    protected function _getTable() {
        return self::TABLE;
    }
}