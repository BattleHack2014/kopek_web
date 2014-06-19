<?php
namespace Crm\Model\Quiz;

use Crm\Model\User\UserCollection;

use Crm\Model\Feedback\Feedback;
use Crm\Model\Feedback\Vote;
use Crm\Model\Feedback\Like;
use Crm\Model\Feedback\Comment;
use Crm\Model\CollectionModel;

class QuizCollection extends CollectionModel {

    protected function newModel($type = null) {
        return new Quiz();
    }
}