<?php
namespace Crm\Logic;

use Crm\Model\Moderated;

use Crm\Model\PromoObject\PromoObject;
use Crm\Model\PromoObject\PromoObjectCollection;
use Crm\Model\PaginatedCollectionDecorator;

use Crm\Model\Storage\MySqlStorage;
use Crm\Model\Statistic\Event\UserEvent;
use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;
use Facebook\FacebookSession;

class Index extends Logic {

    public function actionIndex() {

        FacebookSession::setDefaultApplication('app-id', 'app-secret');

        return array('nice' => 'Oh that is nice example!');
    }
}