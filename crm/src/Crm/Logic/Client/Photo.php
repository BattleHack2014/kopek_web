<?php
namespace Crm\Logic\Client;

use Crm\Model\Moderated;

use Crm\Model\PromoObject\Photo as PhotoModel;
use Crm\Model\Statistic\Event\UserEvent;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Photo extends AuthLogic {

    public function actionAdd() {

        $object = new PhotoModel();
        $object->campaign_id = CAMPAIGN_ID;
        $object->campaign_user_id = $this->_user->id;
        $object->parent_id = 1;
        $object->status = Moderated::PENDING;
        $object->created_at = date('Y-m-' . rand(10, 25));
        $object->updated_at = date('Y-m-' . rand(10, 25));
        $object->save();

        return 'nice';
    }
}