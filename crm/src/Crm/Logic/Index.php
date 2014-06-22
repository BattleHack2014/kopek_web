<?php
namespace Crm\Logic;

use Symfony\Component\Validator\Constraints as Assert;

class Index extends Logic {

    public function actionIndex() {
        $facebook = new \Tool\Facebook();
        if ($facebook->isAuth()) {
            $this->_redirect = '/dashboard';
            return;
        }
        return array('url' => $facebook->getLoginUrl());
    }
}