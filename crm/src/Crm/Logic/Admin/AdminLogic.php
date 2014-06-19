<?php
namespace Crm\Logic\Admin;

use Crm\Model\Admin\User\User;
use Crm\Model\Admin\User\UserFactory;

use Crm\Logic\Logic;

class AdminLogic extends Logic {

    /**
     * @var Acl
     */
    protected $acl = null;

    /**
     * @var User
     */
    protected $_user = null;

    protected function _preExecute() {
        parent::_preExecute();

        if (!Auth::isAuth() &&
             !self::getSession()->get('project', null) &&
             !UserFactory::getInstance()->getCurrentUser()
            ) {
            $this->error(self::STATUS_FORBIDDEN);
        }

        $this->_user = UserFactory::getInstance()->getCurrentUser();
    }
}