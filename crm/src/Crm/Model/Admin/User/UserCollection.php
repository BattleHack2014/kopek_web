<?php
namespace Crm\Model\Admin\User;

use Crm\Model\Storage\DefaultMySqlStorage;

use Crm\Logic\Logic;
use Crm\Model\CollectionModel;
use Crm\Model\Model;

class UserCollection extends CollectionModel {

    protected function newModel($type = null) {
        return new User(new DefaultMySqlStorage());
    }

}