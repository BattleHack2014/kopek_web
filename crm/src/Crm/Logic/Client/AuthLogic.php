<?php
namespace Crm\Logic\Client;

use Crm\Logic\Logic;
use Crm\Model\User\User;
use Tool\ImhonetApiManager;

abstract class AuthLogic extends CampaignLogic {

    const IMHONET_USER_ID_COOKIE = '_user_id';

    /**
     * @var User
     */
    protected $_user = null;

    protected function _preExecute() {
        parent::_preExecute();

        // Если юзер не залогинен, пробуем залогинится
        if(!\Crm\Logic\Logic::getSession()->isAuth())
            $this->auth();

        // Получаем текущего юзера от которого пришел запрос
        if (!$this->_user = \Crm\Model\User\UserFactory::getInstance()->getCurrentUser())
            $this->error(self::STATUS_FORBIDDEN, \Crm\Model\User\User::ERROR_NOT_FOUND);
    }

    protected function auth() {
        $imhoApi = new ImhonetApiManager(Logic::getRequest()->cookies->get(self::IMHONET_USER_ID_COOKIE));

        if (!$imhoApi->checkAuth(Logic::getRequest()->cookies->get('_user_hash')))
            return false;

        if (!$userInfo = $imhoApi->getUserInfo())
            return false;

        $this->_user = new User();
        $this->_user->loadBy(array(
            'campaign_id' => CAMPAIGN_ID,
            'imhonet_user_id' => $userInfo->user_id,
        ));

        $this->_user->campaign_id = CAMPAIGN_ID;
        $this->_user->brand_user_id = $userInfo->user_id; //TODO: check it!
        $this->_user->imhonet_user_id = $userInfo->user_id;
        $this->_user->user_key = $userInfo->alias;
        $this->_user->name = $userInfo->alias;
        $this->_user->is_active = 1;
        $this->_user->contacted_at = date('Y-m-d H:i:s'); //'2013-04-14 00:00:00'
        $this->_user->created_at = date('Y-m-d H:i:s');
        $this->_user->avatar = str_replace('{{size}}', '40x40', $userInfo->picture);
        $this->_user->gender = User::GENDER_UNKNOWN;
        if ($userInfo->sex)
            $this->_user->gender = $userInfo->sex;

        $this->_user->save();

        self::getSession()->setAuth(true);
        self::getSession()->set('user', $this->_user);

        return $this->_user;
    }
}