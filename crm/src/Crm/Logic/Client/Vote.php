<?php
namespace Crm\Logic\Client;

use Crm\Model\Feedback\Vote as VoteModel;

use Crm\Model\Statistic\Event\UserEvent;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Vote extends AuthLogic {

    const PARAM_PROMO_OBJECT_ID = 'promo_object_id';
    const PARAM_RATING = 'rating';

    const EVENT_ADD = 'vote.add';

    /**
     * @var \Crm\Model\PromoObject
     */
    private $_promo_object = null;

    /**
     * @var UserEvent
     */
    private $_event = null;

    protected function _preExecute() {
        parent::_preExecute();
        // Получаем юзера от которого пришел запрос (текущего)
//         if (!$this->_user)
//             $this->error(\Crm\Model\User\User::ERROR_NOT_FOUND);

        // Получаем промо работу
//         $this->_promo_object = new \Crm\Model\PromoObject($this->_param[self::PARAM_PROMO_OBJECT_ID]);
//         if ($this->_promo_object->isExists())
//             $this->error(\Crm\Model\PromoObject::ERROR_NOT_FOUND);

        $this->_event = new UserEvent();
        $this->_event->setUser($this->_user);
        $this->_event->setName(self::EVENT_ADD);

        // Назначаем события
        $this->getEventDispatcher()->addListener(self::EVENT_ADD, function (Event $event) {
            Logic::getErs()->doWrite(PROJECT, Vote::EVENT_ADD, $event->user->id, Logic::getSession()->getId(), array(), array(), Logic::getSystemParam(Logic::PARAM_SYSTEM_LOGGER_DATE));
        });
    }

    /**
     * Пользователь голосует за работу
     */
    public function actionAdd() {
        if (!$this->_userCanVote())
            return;

        $vote = new VoteModel();
        $vote->object_id = 1;
        $vote->campaign_id = CAMPAIGN_ID;
        $vote->parent_id = 1;
        $vote->campaign_user_id = $this->_user->id;
        $vote->imhonet_user_id = 1;
        $vote->created_at = date('Y-m-d');
        $vote->user_key = 'key';
        $vote->value_text = 'value';
        $vote->save();


        // Оповещаем о событии
        $this->getEventDispatcher()->dispatch(self::EVENT_ADD, $this->_event);

        return 'nice';
    }

    /**
     * Может ли пользователь голосовать за работу
     * В случае если не может, вернет конкретную ошибку
     */
    public function actionCheck($params) {
        if (!$this->_userCanVote())
            return;

        return true;
    }

    protected function _inputValidate()
    {
        parent::_inputValidate();

        switch($this->_action) {
            case 'actionAdd':
            case 'actionCheck':
//                 $errors = self::getValidator()->validateValue($this->_param, new Assert\Collection(array(
//                     self::PARAM_PROMO_OBJECT_ID => array(
//                         new Assert\NotBlank(),
//                         new Assert\Type(array('type' => 'numeric'))
//                     ),
//                     self::PARAM_RATING => array(
//                         new Assert\NotBlank(),
//                         new Assert\Type(array('type' => 'numeric')),
//                         new Assert\Range(array('min' => 1, 'max' => 5)),
//                     ),
//                 )));

//                 foreach ($errors as $error)
//                     $this->error($error->getPropertyPath() . ' - ' . $error->getMessage());
                break;
        }
    }

    /**
     * Набор условий для проверки может ли пользователь голосовать за работу
     */
    private function _userCanVote() {
//         if (!$this->_user->isPromo())
//             $this->error(\Crm\Model\User\User::ERROR_NOT_PROMO);

//         if ($this->_user->isBanForVote())
//             $this->error(\Crm\Model\User\User::ERROR_BAN_FOR_VOTE);

        return true;
    }
}