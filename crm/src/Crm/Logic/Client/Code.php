<?php
namespace Crm\Logic\Client;

use Crm\Logic\Logic;

use Crm\Model\Statistic\Event\CodeEvent;

use Crm\Model\Statistic\Event\UserEvent;

use Crm\Model\Code as CodeModel;

use Symfony\Component\Validator\Constraints as Assert;

class Code extends AuthLogic {

    const PARAM_CODE = 'filter';

    const ERROR_NOT_FOUND = 'Код не найден';
    const SUCCESS_ACTIVATED = 'Код активирован';

    const EVENT_CHECK = 'code.check';

    private $_event = null;

    protected function _preExecute() {
        parent::_preExecute();

        $this->_event = new CodeEvent();
        $this->_event->setUser($this->_user);
        $this->_event->setName(self::EVENT_CHECK);

        // Назначаем события
        $this->getEventDispatcher()->addListener(self::EVENT_CHECK, function (CodeEvent $event) {
            $params = array();
            if ($event->status) $params[1] = $event->status;
            Logic::getErs()->doWrite(PROJECT, $event->getName(), $event->user->id, Logic::getSession()->getId(), array(), $params, Logic::getSystemParam(Logic::PARAM_SYSTEM_LOGGER_DATE));
        });
    }

    public function actionCheck() {
        $code = new CodeModel();
        if (!$code->loadBy(array('code' => $this->_param[self::PARAM_CODE]))) {
            $this->_event->status = CodeEvent::STATUS_WRONG;
            $this->_message = self::ERROR_NOT_FOUND;

        } elseif ($code->isActivated()) {
            $this->_event->status = CodeEvent::STATUS_DUPLICATE;
            $this->_message = self::ERROR_NOT_FOUND;

        } else {
            $code->status = CodeModel::STATUS_ACTIVE;
            $code->campaign_user_id = $this->_user->id;
            $code->updated_at = date('Y-m-d H:i:s');
            $code->save();

            $this->_message = self::SUCCESS_ACTIVATED;
            $this->_event->status = CodeEvent::STATUS_RIGHT;
        }

        $this->getEventDispatcher()->dispatch(self::EVENT_CHECK, $this->_event);
    }

    protected function _inputValidate()
    {
        parent::_inputValidate();

        switch($this->_action) {
            case 'actionCheck':
                $errors = self::getValidator()->validateValue($this->_param, new Assert\Collection(array(
                    self::PARAM_CODE => array(
                        new Assert\NotBlank(),
                    ),
                )));

                foreach ($errors as $error)
                        $this->error(self::STATUS_VALIDATION_FAILED, $error->getPropertyPath() . ' - ' . $error->getMessage());
                break;
        }
    }

}