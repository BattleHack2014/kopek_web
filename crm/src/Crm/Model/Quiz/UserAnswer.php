<?php
/**
 * Created by JetBrains PhpStorm.
 * User: starcode2
 * Date: 6/11/13
 * Time: 9:43 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Crm\Model\Quiz;

use Crm\Model\User\User;

use Crm\Logic\Logic;
use \Crm\Model\Model;

class UserAnswer extends Model {

    const TABLE = 'quiz_user_answer';

    public $campaign_id;
    public $quiz_id;
    public $user_id;
    public $question_id;
    public $answer_id;

    protected function _getTable() {
        return self::TABLE;
    }
}