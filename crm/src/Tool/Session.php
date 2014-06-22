<?php
namespace Tool;

use Crm\Logic\Logic;

use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;

class Session extends SymfonySession
{
    const KEY_IS_AUTH = 'is_auth';

    public function setAuth($id) {
        $this->set(self::KEY_IS_AUTH, $id);
    }

    public function isAuth() {
        return $this->get(self::KEY_IS_AUTH);
    }

    public function generateRemberMeHash($id) {
        return md5($id . rand(1,100000));
    }

    public function getRememberMeHash($id) {
        return Logic::getRequest()->cookies->get($id, null);
    }

    public function setRememberMe($id, $hash) {
        setcookie($id, $hash, time() + 60 * 60 * 24 * 90, '/');
    }

    public function unsetRememberMe($id) {
        setcookie($id, '', 1, '/');
    }

    public function setProject($id, $project) {

    }
}