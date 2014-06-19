<?php
namespace Crm\Model\Statistic\Event;

use Crm\Model\User\User;

use Symfony\Component\EventDispatcher\Event;

class UserEvent extends Event {

    /**
     * @var User
     */
    public $user = null;

    const NAME = 'user';

    public function setUser($user) {
        $this->user = $user;
    }
}