<?php
namespace Crm\Model\Statistic\Event;

use Symfony\Component\EventDispatcher\Event;

class ModerationEvent extends Event {

    const ACTION_APPROVE = 'approve';
    const ACTION_REJECT = 'reject';

    const NAME = 'moderation';

    public $action = null;

}