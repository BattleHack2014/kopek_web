<?php
namespace Crm\Model\Quiz;

use Crm\Model\CollectionModel;

class QuestionCollection extends CollectionModel {

    protected function newModel($type = null) {
        return new Question();
    }
}