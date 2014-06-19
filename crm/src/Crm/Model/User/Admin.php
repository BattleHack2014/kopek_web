<?php
namespace Crm\Model\User;

use \Crm\Model\Model;

class Admin extends Model {

    const TABLE = 'admin_user';

    const ERROR_NOT_FOUND = 'Пользователь не найден';

    public $id;
    public $email;
    public $password;
    public $roles;

    protected function _getTable() {
        return self::TABLE;
    }
}