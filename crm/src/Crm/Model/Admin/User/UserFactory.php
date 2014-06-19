<?php
namespace Crm\Model\Admin\User;

use Crm\Model\Model;
use Crm\Model\Storage\DefaultMySqlStorage;
use Crm\Logic\Logic;

class UserFactory
{

    /**
     * @var User
     */
    private $current_user = null;

    /**
     * @var UserFactory
     */
    private static $instance = null;

    private $users = array();

    /**
     * @return UserFactory
     */
    public static function getInstance()
    {
        if (self::$instance === null)
            self::$instance = new self();

        return self::$instance;
    }

    public function loadBy(array $fields) {
        $user = new User(new DefaultMySqlStorage());
        if (!$user->loadBy($fields))
            return null;

        return $user;
    }

    /**
     * @return User
     */
    public function getCurrentUser($id = null)
    {
        if ($this->current_user !== null)
            return $this->current_user;
        else
           $this->current_user = new User(new DefaultMySqlStorage());

        //TODO temp code, hack for testing
        foreach (array($id, Logic::getSession()->get('user_id')) as $id) {
            if (!$id)
                continue;

            if (isset($this->users[$id]))
                return $this->users[$id];

            return $this->current_user->loadBy(array('id' => $id));
        }

        return null;
    }

}