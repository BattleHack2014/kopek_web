<?php
namespace Crm\Model\Statistic\Event;

use Symfony\Component\EventDispatcher\Event;

class CodeEvent extends UserEvent {

    const STATUS_RIGHT = 'right';
    const STATUS_WRONG = 'wrong';
    const STATUS_DUPLICATE = 'duplicate';

    public $status = null;

}