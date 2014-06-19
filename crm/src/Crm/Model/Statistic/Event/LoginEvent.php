<?php
namespace Crm\Model\Statistic\Event;

use Symfony\Component\EventDispatcher\Event;

class LoginEvent extends UserEvent {

    const SOCIAL_FB = 'FB';
    const SOCIAL_VK = 'VK';
    const SOCIAL_OK = 'OK';

    public $social = null;

    const EVENT = 'login';

    public function __construct($user) {
        $this->setUser($user);
        $this->setName(self::EVENT);
    }

    public function setSocial($social = null) {
        $this->social = $social;

        return $this;
    }
}