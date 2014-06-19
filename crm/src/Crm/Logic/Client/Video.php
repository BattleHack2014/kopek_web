<?php
namespace Crm\Logic\Client;

use Crm\Model\Moderated;

use Crm\Model\PromoObject\Video as VideoModel;
use Crm\Model\Statistic\Event\UserEvent;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Video extends AuthLogic {

    public function actionAdd() {

        $object = new VideoModel();
        $object->campaign_id = CAMPAIGN_ID;
        $object->campaign_user_id = $this->_user->id;
        $object->type_id = 1;
        $object->parent_id = 1;
        $object->status = Moderated::PENDING;
        $object->created_at = date('Y-m-d');
        $object->updated_at = date('Y-m-d');
        $object->save();

        return 'nice';
    }
}