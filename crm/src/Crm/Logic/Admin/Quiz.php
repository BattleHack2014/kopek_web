<?php
namespace Crm\Logic\Admin;

use Config\Config;

use Crm\Model\Admin\User\User;

use Crm\Logic\Logic;
use Crm\Model\Admin\User\UserFactory;
use Crm\Model\Quiz\QuizCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Quiz extends AdminLogic {

    public function actionGet() {

        $quiz = new QuizCollection();
        $quiz->loadBy(array(
            'campaign_id' => UserFactory::getInstance()->getCurrentUser()->current_campaign_id,
        ));

        return array('items' => $quiz->toArray());
    }
}