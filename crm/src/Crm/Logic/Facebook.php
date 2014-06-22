<?php
namespace Crm\Logic;

use Facebook\FacebookRequestException;
use Symfony\Component\Validator\Constraints as Assert;

class Facebook extends Logic {

    public function actionIndex() {
        $facebook = new \Tool\Facebook();
        if(!$facebook->isAuth()) {
            $this->_redirect = '/';
        }
        try {
            $facebook->auth();
            if ($facebook->isNewUser()) {
                $this->_redirect = '/goal';
            } else {
                $this->_redirect = '/dashboard';
            }
        } catch(FacebookRequestException $e) {
            $this->_redirect = '/';
        }
    }
}