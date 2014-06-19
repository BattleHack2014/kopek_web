<?php
namespace Crm\Model\User;

use Crm\Model\Model;

use \Crm\Logic\Logic;

class UserFactory
{

    /**
     * @var User
     */
    protected $current_user = null;

    /**
     * @var UserFactory
     */
    private static $instance = null;

    /**
     * @return UserFactory
     */
    public static function getInstance()
    {
        if (self::$instance === null)
            self::$instance = new self();

        return self::$instance;
    }

    /**
     * @return User
     */
    public function getCurrentUser($id = null)
    {
        if ($user = Logic::getSession()->get('user'))
            return $user;


    }

}