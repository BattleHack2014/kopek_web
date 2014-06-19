<?php
namespace Crm\Model\Statistic\Event;

use Symfony\Component\EventDispatcher\Event;

class LikeEvent extends UserEvent {

    const TYPE_OBJECT = 'o';

    public $id;
    public $type;
    public $social;

}