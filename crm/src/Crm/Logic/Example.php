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

class Example extends Logic {

    protected function _preExecute() {
        parent::_preExecute();
        // Do something
    }

    public function actionIndex() {
        return array('nice' => 'Oh that is nice example!');
    }
}