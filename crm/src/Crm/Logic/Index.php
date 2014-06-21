<?php
namespace Crm\Logic;

session_start();

use Crm\Model\Moderated;

use Crm\Model\PromoObject\PromoObject;
use Crm\Model\PromoObject\PromoObjectCollection;
use Crm\Model\PaginatedCollectionDecorator;

use Crm\Model\Storage\MySqlStorage;
use Crm\Model\Statistic\Event\UserEvent;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;

class Index extends Logic {

    public function actionIndex() {
        $result = FacebookSession::setDefaultApplication('266389886878271', '7d243c984b5ca08387fd690c3fe4adf9');
        
        if ($_SESSION['user']) {
            $session = $_SESSION['user'];
        } else {
            $helper = new FacebookRedirectLoginHelper(
                'http://www.battlehack2014.com:5002/index/index'
            );  
            $session = $helper->getSessionFromRedirect();
            if ($session) {
                $_SESSION['user'] = $session;
            }
        }
        
        if($session) {
            try {
                $user_profile = (new FacebookRequest(
                  $session, 'GET', '/me'
                ))->execute()->getGraphObject(GraphUser::className());

//                echo "Name: " . $user_profile->getName();

                $user_data = (new FacebookRequest(
                  $session, 'GET', '/me'
                ))->execute()->getGraphObject(GraphObject::className());

//                echo "<br>Email: " . $user_data->getProperty('email');
            } catch(FacebookRequestException $e) {

                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();
            }
            
            return array('name' => $user_profile->getName());
        } else {
            $helper = new FacebookRedirectLoginHelper(
                'http://www.battlehack2014.com:5002/index/index'
            );
            return array('url' => $helper->getLoginUrl());
        }
        
        
        
    }
}