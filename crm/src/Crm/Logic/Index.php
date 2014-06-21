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
        FacebookSession::setDefaultApplication(
            $this->getConfig('config')->get('appId'),
            $this->getConfig('config')->get('appSecret')
        );

        $helper = new FacebookRedirectLoginHelper(
            $this->getConfig('config')->get('base_url') . '/index/index'
        );
        
        $session = $helper->getSessionFromRedirect();
        
        if($session) {

        try {
            $user_profile = (new FacebookRequest(
              $session, 'GET', '/me'
            ))->execute()->getGraphObject(GraphUser::className());

            echo "Name: " . $user_profile->getName();
            
            $user_data = (new FacebookRequest(
              $session, 'GET', '/me'
            ))->execute()->getGraphObject(GraphObject::className());
            
            echo "<br>Email: " . $user_data->getProperty('email');

          } catch(FacebookRequestException $e) {

            echo "Exception occured, code: " . $e->getCode();
            echo " with message: " . $e->getMessage();

          }   
          $login ='';
        } else {
            $login = $helper->getLoginUrl();
        }
        
        
        return array('url' => $login);
    }
}