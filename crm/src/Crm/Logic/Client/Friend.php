<?php
namespace Crm\Logic\Client;

use Crm\Model\Statistic\Event\UserEvent;

use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Friend extends AuthLogic {

    const EVENT_ADD = 'friend.add';

    protected function _preExecute() {
        parent::_preExecute();

        $this->initDefaultUserEvent(self::EVENT_ADD);

        // Назначаем события
        $this->getEventDispatcher()->addListener(self::EVENT_ADD, function (Event $event) {
            Logic::getErs()->doWrite(PROJECT, Friend::EVENT_ADD, $event->user->id, Logic::getSession()->getId(), array(), array(), Logic::getSystemParam(Logic::PARAM_SYSTEM_LOGGER_DATE));
        });
    }

    public function actionAdd() {

        // Оповещаем о событии
        $this->getEventDispatcher()->dispatch(self::EVENT_ADD, $this->_user_event);

        return 'nice';
    }

    protected function _inputValidate()
    {
        parent::_inputValidate();

        switch($this->_action) {
            case 'actionAdd':
                break;
        }
    }
}