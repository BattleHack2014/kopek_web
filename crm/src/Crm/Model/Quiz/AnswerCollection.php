<?php
namespace Crm\Model\Quiz;

use Crm\Model\CollectionModel;

class AnswerCollection extends CollectionModel {

    protected function newModel($type = null) {
        return new Answer();
    }
}