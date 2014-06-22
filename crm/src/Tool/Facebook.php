<?php
namespace Tool;

use Crm\Logic\Logic;

use Crm\Model\User\User;
use Crm\Model\User\UserFactory;
use Facebook\FacebookRequest;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;

class Facebook
{
    private $helper;

    private $session;

    private $isNewUser = true;

    public function __construct()
    {
        Logic::getSession();

        FacebookSession::setDefaultApplication(
            Logic::getConfig('config')->get('appId'),
            Logic::getConfig('config')->get('appSecret')
        );

        $this->helper = new FacebookRedirectLoginHelper(
            Logic::getConfig('config')->get('base_url') . '/facebook'
        );

        $this->session = $this->helper->getSessionFromRedirect();
    }

    public function auth()
    {
        $user_profile = (new FacebookRequest(
            $this->getSession(), 'GET', '/me'
        ))->execute()->getGraphObject(GraphUser::className());

        $fbId = $user_profile->getProperty('id');
        $session = Logic::getSession();
        $session->setAuth($fbId);
        $user = new User();
        if ($user->loadBy(array('fb_id' => $fbId))) {
            $this->isNewUser = false;
        } else {
            $user->fb_id = $fbId;
            $user->name = $user_profile->getProperty('name');
            $user->paypal_email = $user_profile->getProperty('email');
            $user->email = $user_profile->getProperty('email');
            $user->save();
        }
        $session->set('user', $user);
    }

    public function isNewUser()
    {
        return $this->isNewUser;
    }

    public function getLoginUrl()
    {
        return $this->helper->getLoginUrl();
    }

    public function isAuth()
    {
        return (bool) $this->session;
    }

    public function getSession()
    {
        return $this->session;
    }
}