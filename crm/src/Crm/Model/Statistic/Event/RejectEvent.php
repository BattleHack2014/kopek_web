<?php
namespace Crm\Model\Statistic\Event;

use Symfony\Component\EventDispatcher\Event;

class RejectEvent extends UserEvent {

    const REJECT_SUBSCRIPTION = 'subscription';
    const REJECT_PARTICIPATION = 'participation';

    public $type = null;
}