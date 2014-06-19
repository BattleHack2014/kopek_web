<?php
namespace Crm\Logic\Admin;

use Crm\Model\Storage\MySqlStorage;

use Crm\Model\PaginatedCollectionDecorator;

use Crm\Model\Storage\DefaultMySqlStorage;
use Crm\Model\Admin\User\UserFactory;
use Crm\Model\Admin\User\UserCollection;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;

class User extends AdminLogic {

    const PARAM_LOGIN = 'login';
    const PARAM_PASS = 'password';
    const PARAM_RIGHTS = 'rights';

    const PARAM_PER_PAGE = 'perPage';
    const PARAM_CURRENT_PAGE = 'currentPage';

    const PARAM_SORT_DIRECTION = 'sortDirection';

    const PARAM_ID = 'id';

    public function actionGet() {
        $collection = new PaginatedCollectionDecorator(new UserCollection(new DefaultMySqlStorage()));
        $collection->perPage = $this->_param[self::PARAM_PER_PAGE];
        $collection->currentPage = $this->_param[self::PARAM_CURRENT_PAGE];
        $collection->collection->_storage->order('login', $this->_param[self::PARAM_SORT_DIRECTION] == 1 ? MySqlStorage::ORDER_ASC : MySqlStorage::ORDER_DESC);
        $collection->loadBy(array(
            'project' => self::getSession()->get('project'),
        ));

        $result = array();
        foreach ($collection as $user) {
            $result[] = array(
                'login' => $user->login,
                'rights' => $user->formatResources()
            );
        }

        return array('users' => $result, 'totalRecords' => $collection->count(), 'currentPage' => $collection->currentPage);
    }

    public function actionResources() {
        $result = array();
        foreach (Logic::getConfig('menu') as $resource => $data) {
            $result[] = array(
                'id' => $data['id'],
                'label' => $data['label'],
                'value' => $data['default'],
            );
        }

        return array('listRights' => $result);
    }

    public function actionSave() {
        $user = UserFactory::getInstance()->loadBy(array(
            'login' => $this->_param[self::PARAM_LOGIN],
        ));

        if (!$user) $user = new \Crm\Model\Admin\User\User(new DefaultMySqlStorage());

        $user->login = $this->_param[self::PARAM_LOGIN];
        if ($this->_param[self::PARAM_PASS])
            $user->password = md5($this->_param[self::PARAM_PASS]);

        $menu = Logic::getConfig('menu');
        $resources = array();
        foreach ($this->_param[self::PARAM_RIGHTS] as $resource)
            if (filter_var($resource['value'], FILTER_VALIDATE_BOOLEAN))
                foreach ($menu as $key => $data)
                    if ($resource['id'] == $data['id'])
                        $resources[] = $key;

        $user->resources = json_encode($resources);
        $user->project = self::getSession()->get('project');
        $user->save();

        return 'nice';
    }

    public function actionDelete() {
        $user = UserFactory::getInstance()->loadBy(array(
            'login' => $this->_param[self::PARAM_ID],
        ));

        if ($user) $user->delete();

        return 'nice';
    }

    protected function _inputValidate()
    {
        parent::_inputValidate();

        switch($this->_action) {
            case 'actionGet':
                if (!isset($this->_param[self::PARAM_CURRENT_PAGE]))
                    $this->_param[self::PARAM_CURRENT_PAGE] = 1;

                if (!isset($this->_param[self::PARAM_SORT_DIRECTION]))
                    $this->_param[self::PARAM_SORT_DIRECTION] = MySqlStorage::ORDER_ASC;

                break;
            case 'actionSave':
                $asserts = array(
                    self::PARAM_LOGIN => array(
                        new Assert\NotBlank(),
                        new Assert\Email(),
                    ),
                    self::PARAM_RIGHTS => array(),
                );

                $asserts[self::PARAM_PASS] = array();

                $errors = self::getValidator()->validateValue($this->_param, new Assert\Collection($asserts));

                foreach ($errors as $error)
                    $this->error(self::STATUS_VALIDATION_FAILED, $error->getPropertyPath() . ' - ' . $error->getMessage());
                break;
        }
    }
}