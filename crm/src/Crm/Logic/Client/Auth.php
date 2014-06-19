<?php
namespace Crm\Logic\Client;

use Crm\Model\Statistic\Event\LoginEvent;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

use Tool\ImhonetApiManager;
use Crm\Model\User\User;

class Auth extends AuthLogic {

    const EVENT_LOGIN = 'login';

    public function actionLogin() {
        $this->auth();

        // Кода мало - пока обходимся без $this->getEventDispatcher()->dispatch()
        Logic::getErs()->doWrite(PROJECT, self::EVENT_LOGIN, $this->_user->id);

        if (!empty($this->_param['redirect_url'])) {
            return $this->_param['redirect_url'];
        }

        return 'http://localhalacost/';
    }

    public function actionLogout() {
        // Разлогиниваем пользователя на Имхонете
        Logic::getRequest()->cookies->remove(AuthLogic::IMHONET_USER_ID_COOKIE);

        // Чистим локальную сессию
        Logic::getSession()->invalidate();
        //Logic::getSession()->clear();
    }
}