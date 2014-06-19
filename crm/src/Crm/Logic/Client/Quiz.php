<?php
namespace Crm\Logic\Client;

use Config\Config;

use Crm\Logic\Client\AuthLogic;
use Crm\Model\Admin\User\User;

use Crm\Logic\Logic;
use Crm\Model\Admin\User\UserFactory;
use Crm\Model\Quiz\QuizCollection;
use Crm\Model\Quiz\UserAnswer;
use Silex\Application;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;
use Crm\Model\Campaign\CampaignCollection;
use Tool;

class Quiz extends AuthLogic {

    public function actionGet() {

        $quiz = new \Crm\Model\Quiz\Quiz();
        if (!$quiz->loadBy(array( 'campaign_id' => CAMPAIGN_ID )))
            return array('items' => array());

        $quiz->loadRelated('question');

        return array('items' => $quiz->toArray());
    }

}