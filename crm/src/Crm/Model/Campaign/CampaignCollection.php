<?php
namespace Crm\Model\Campaign;

use Crm\Logic\Logic;
use Crm\Model\Campaign\Campaign;
use Crm\Model\CollectionModel;
use Crm\Model\Storage\DefaultMySqlStorage;

class CampaignCollection extends CollectionModel {

    public function __construct(Storage $storage = null) {
        parent::__construct(new DefaultMySqlStorage());
    }

    public function activate() {
        $stmt = $this->_storage->getWriter()->executeQuery('UPDATE ' . Campaign::TABLE . ' SET is_active = 1 WHERE start_date < NOW() AND end_date > NOW();');
        if ($stmt->rowCount()) {
            Campaign::clearCache();
            return true;
        }
        return false;
    }

    public function deactive() {
        $stmt = $this->_storage->getWriter()->executeQuery('UPDATE ' . Campaign::TABLE . ' SET is_active = 0 WHERE end_date < NOW();');
        if ($stmt->rowCount()) {
            Campaign::clearCache();
            return true;
        }
        return false;
    }

    protected function newModel($type = null) {
        return new Campaign();
    }
}