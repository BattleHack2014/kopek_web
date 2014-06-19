<?php
namespace Crm\Logic\Client;

use Crm\Logic\Logic;
use Crm\Model\CacheManager;
use Crm\Model\Campaign\Campaign;

class CampaignLogic extends Logic {

    protected function _preExecute() {
        /* @var $campaign Campaign */
        $campaign = CacheManager::loadModelBy(new Campaign(), array('id' => CAMPAIGN_ID));

        if (!$campaign || !$campaign->is_active)
            $this->error(Logic::STATUS_NOT_FOUND, "Проект закончился или не найден");

        parent::_preExecute();
    }
}