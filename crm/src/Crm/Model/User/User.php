<?php
namespace Crm\Model\User;

use \Crm\Model\Model;

class User extends Model {

    const TABLE = 'user';

    public $id;
    public $name;
    public $paypal_email;
    public $email;
    public $fb_token;
    public $fb_id;


    protected function _getTable() {
        return self::TABLE;
    }
}