<?php
namespace Crm\Logic\Client;

use Crm\Model\Statistic\Event\RegisterEvent;

use Crm\Model\Statistic\Event\LoginEvent;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Register extends AuthLogic {

    const EVENT_REGISTER = 'register';

    /**
     * @var Event
     */
    private $_event = null;

    protected function _preExecute() {
        parent::_preExecute();
        // Получаем юзера от которого пришел запрос (текущего)
//         if (!$this->_user)
//             $this->error(\Crm\Model\User\User::ERROR_NOT_FOUND);

        $this->_event = new RegisterEvent();
        $this->_event->setUser($this->_user);
        $this->_event->setName(self::EVENT_REGISTER);

        // Назначаем события
        $this->getEventDispatcher()->addListener(self::EVENT_REGISTER, function (RegisterEvent $event) {
            Logic::getErs()->doWrite(PROJECT, Register::EVENT_REGISTER, $event->user->id, Logic::getSession()->getId(), array(), array(), Logic::getSystemParam(Logic::PARAM_SYSTEM_LOGGER_DATE));
        });
    }

    public function actionRegister() {

        $this->getEventDispatcher()->dispatch(self::EVENT_REGISTER, $this->_event);
    }

    protected function _inputValidate()
    {
        parent::_inputValidate();

        switch($this->_action) {
            case 'actionRegister':
                break;
        }
    }
}