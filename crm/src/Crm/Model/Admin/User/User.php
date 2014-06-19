<?php
namespace Crm\Model\Admin\User;

use Crm\Logic\Logic;
use \Crm\Model\Model;

class User extends Model {

    const TABLE = 'admin_user';

    const ERROR_NOT_FOUND = 'Пользователь не найден';

    const COOKIE_REMEMBER_ME = 'admin_remember';

    protected $_available_resources = array(
        'Administration',
        'Sections',
        'Statistic',
    );

    public $id;
    public $login;
    public $password;
    public $resources;
    public $remember_hash;
    public $project;
    public $current_campaign_id;

    public function hasResource($resource) {
        return in_array($resource, json_decode($this->resources, true));
    }

    public function formatResources() {
        $result = array();
        foreach (Logic::getConfig('menu') as $resource => $data) {
            $result[] = array(
                'id' => $data['id'],
                'label' => $data['label'],
                'value' => in_array($resource, json_decode($this->resources, true)) ? true : false,
            );
        }
        return $result;
    }

    public function getPreview() {
        return '/Resources/photo/admin/'.$this->id.'.jpg';
    }

    protected function _getTable() {
        return self::TABLE;
    }
}