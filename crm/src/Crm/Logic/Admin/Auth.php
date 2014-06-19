<?php
namespace Crm\Logic\Admin;

use Crm\Model\Admin\User\UserFactory;
use Crm\Model\Storage\DefaultMySqlStorage;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Auth extends Logic {

    const PARAM_LOGIN = 'login';
    const PARAM_PASS = 'password';
    const PARAM_REMEMBER = 'remember';

    public function actionLogin() {
        $user = UserFactory::getInstance()->loadBy(array(
            'login' => $this->_param[self::PARAM_LOGIN],
            'password' => md5($this->_param[self::PARAM_PASS]),
        ));

        if (!$user)
            $this->error(self::STATUS_FORBIDDEN, 'Логин или пароль неверен');

        self::auth($user, $this->_param[self::PARAM_REMEMBER]);

        $this->_redirect = '/';
    }

    public function actionLogout() {
        self::logout();
    }

    public static function auth(\Crm\Model\Admin\User\User $user, $isRemember) {
        self::getSession()->setAuth(true);
        self::getSession()->set('user_id', $user->id);
        self::getSession()->set('project', $user->project);

        if ($isRemember) {
            // Обновляем remember me куку
            $user->remember_hash = self::getSession()->generateRemberMeHash($user->email . $user->password);
            self::getSession()->setRememberMe(\Crm\Model\Admin\User\User::COOKIE_REMEMBER_ME, $user->remember_hash);
            $user->save();
        }
    }

    public static function isAuth($isRemember = true) {
        if (!UserFactory::getInstance()->getCurrentUser()) {
            if ($isRemember && ($remember_hash = self::getSession()->getRememberMeHash(\Crm\Model\Admin\User\User::COOKIE_REMEMBER_ME))) {
                if ($user = UserFactory::getInstance()->loadBy(array('remember_hash' => $remember_hash,))) {
                    Auth::auth($user, true);
                    return true;
                }
            }
            self::logout();
            return false;
        }

        if (self::getSession()->isAuth())
            return true;

        return false;
    }

    public static function logout() {
        self::getSession()->clear();
        self::getSession()->unsetRememberMe(\Crm\Model\Admin\User\User::COOKIE_REMEMBER_ME);
    }

    protected function _inputValidate()
    {
        parent::_inputValidate();

        switch($this->_action) {
            case 'actionLogin':
                $errors = self::getValidator()->validateValue($this->_param, new Assert\Collection(array(
                    self::PARAM_LOGIN => array(
                        new Assert\NotBlank(),
                        new Assert\Email(),
                    ),
                    self::PARAM_PASS => array(
                        new Assert\NotBlank(),
                    ),
                    self::PARAM_REMEMBER => array(
                        new Assert\NotBlank(),
                    ),
                )));

                foreach ($errors as $error)
                    $this->error(self::STATUS_VALIDATION_FAILED, $error->getPropertyPath() . ' - ' . $error->getMessage());
                break;
        }
    }
}