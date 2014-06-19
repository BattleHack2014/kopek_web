<?php
namespace Crm\Logic\Client;

use Crm\Model\Feedback\Feedback;
use Crm\Model\Statistic\Event\LikeEvent;
use Crm\Model\Statistic\Event\UserEvent;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Like extends AuthLogic {

    const EVENT_ADD = 'like.add';

    const PARAM_ID = 'id';
    const PARAM_SOCIAL_NETWORK = 'socialNetwork';

    /**
     * @var LikeEvent
     */
    private $_event = null;

    protected function _preExecute() {
        if (Logic::getSession()->isAuth()) {
            parent::_preExecute();
        }
    }

    /**
     * Пользователь лайкает работу
     */
    public function actionAdd() {
        $id = $this->_param['id'];
        $social = $this->_param['social'];
        $value = abs($this->_param['value']) <= 1 ? $this->_param['value'] : 0;
        $object = new \Crm\Model\PromoObject\PromoObject();
        $object->loadBy(array('id' => $id));
        if ($value == 1) {
            $object->incrementLike($social);
            $user_id = ($this->_user) ? $this->_user->id : 0;
            Logic::getErs()->doWrite(PROJECT, 'like_essay', $user_id, Logic::getSession()->getId(), array(), array($object->id, strtoupper($social)));
        }
        elseif ($value == -1)
            $object->decrementLike($social);

        return true;
    }

    public function actionSocial() {
        $this->_event->id = $this->_param[self::PARAM_ID];
        $this->_event->type = LikeEvent::TYPE_OBJECT;
        $this->_event->social = strtoupper($this->_param[self::PARAM_SOCIAL_NETWORK]);

        // Оповещаем о событии
        $this->getEventDispatcher()->dispatch(self::EVENT_ADD, $this->_event);

        return 'nice';
    }
}