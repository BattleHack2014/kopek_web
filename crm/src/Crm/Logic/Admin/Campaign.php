<?php
namespace Crm\Logic\Admin;

use Crm\Model\Admin\User\UserFactory;
use Config\Config;
use Crm\Model\Admin\User\User;
use Crm\Logic\Logic;
use Crm\Model\Campaign\CampaignCollection;
use Symfony\Component\Validator\Constraints as Assert;

class Campaign extends AdminLogic {

    const PARAM_CURRENT_PROMO_ID = 'id';

    public function actionGet() {
        $campaign_collection = new CampaignCollection();
        $campaign_collection->loadBy(array('code' => $this->_user->project));

        $items = array();
        foreach ($campaign_collection as $id => $campaign)
            $items[] = $campaign->toArray();

        return array('items' => $items);
    }

    public function actionSave() {
        if (!$user = UserFactory::getInstance()->getCurrentUser())
            $this->error(self::STATUS_FORBIDDEN);

        $user->current_campaign_id = $this->_param[self::PARAM_CURRENT_PROMO_ID];
        $user->save();

        return 'nice';
    }
}