<?php
namespace Crm\Logic\Client;

use Crm\Logic\Logic;

use Crm\Model\Statistic\Event\RegisterEvent;

use Crm\Model\Statistic\Event\RejectEvent;

use Crm\Model\Code as CodeModel;

use Symfony\Component\Validator\Constraints as Assert;

class Reject extends AuthLogic {

    const EVENT_REJECT = 'reject';

    protected function _preExecute() {
        parent::_preExecute();

        // Назначаем события
        $this->getEventDispatcher()->addListener(self::EVENT_REJECT, function (RejectEvent $event) {
            $params = array();
            if ($event->type)
                $params[1] = $event->type;

            Logic::getErs()->doWrite(PROJECT, Reject::EVENT_REJECT, $event->user->id, Logic::getSession()->getId(), array(), $params, Logic::getSystemParam(Logic::PARAM_SYSTEM_LOGGER_DATE));
        });
    }

    public function actionSubscribtion() {
        $this->initRejectEvent()->type = RejectEvent::REJECT_SUBSCRIPTION;
        $this->getEventDispatcher()->dispatch(self::EVENT_REJECT, $this->_event);

        $this->_message = 'Вы успешно отписались от рассылки';

        return null;
    }

    public function actionParticipation() {
        $this->initRejectEvent()->type = RejectEvent::REJECT_PARTICIPATION;
        $this->getEventDispatcher()->dispatch(self::EVENT_REJECT, $this->_event);

        $this->_message = 'Вы успешно отписались от участия в акции';

        return null;
    }

    /**
     * @return RejectEvent
     */
    protected function initRejectEvent() {
        $this->_event = new RejectEvent();
        $this->_event->setUser($this->_user);
        $this->_event->setName(self::EVENT_REJECT);
        return $this->_event;
    }
}