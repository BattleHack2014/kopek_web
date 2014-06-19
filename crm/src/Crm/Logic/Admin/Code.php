<?php
namespace Crm\Logic\Admin;

use Crm\Model\Code as CodeModel;

use Symfony\Component\Validator\Constraints as Assert;

class Code extends AdminLogic {

    const PARAM_CODE = 'filter';

    const ERROR_NOT_FOUND = 'отсутствует';

    public function actionCheck() {
        $code = new CodeModel();
        if (!$code->loadBy(array('code' => $this->_param[self::PARAM_CODE])) || !$code->loadRelated())
            return array('codes' => array('status' => self::ERROR_NOT_FOUND));

        return array('codes' => array(array(
            'status' => $code->translateStatus(),
            'date' => $code->updated_at,
            'code' => $code->code,
            'user' => $code->_user->name,
        )));
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