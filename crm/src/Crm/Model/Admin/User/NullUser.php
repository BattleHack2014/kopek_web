<?php
namespace Crm\Model\Admin\User;

use Crm\Logic\Logic;
use \Crm\Model\Model;

class NullUser extends Model {

    const TABLE = 'admin_user';

    public $id = null;
    public $login = null;
    public $password = null;
    public $resources = null;
    public $remember_hash = null;
    public $project = null;
    public $current_campaign_id = null;

    public function hasResource($resource) {
        return false;
    }

    public function formatResources() {
        return array();
    }

    protected function _getTable() {
        return self::TABLE;
    }
}