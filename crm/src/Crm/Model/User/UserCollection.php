<?php
namespace Crm\Model\User;

use Crm\Logic\Logic;
use Crm\Model\CollectionModel;
use Crm\Model\Model;

class UserCollection extends CollectionModel {

    protected function newModel($type = null) {
        return new User();
    }

}