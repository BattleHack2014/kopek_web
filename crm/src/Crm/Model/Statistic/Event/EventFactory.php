<?php
namespace Crm\Model\Statistic\Event;

use Crm\Model\User\UserFactory;
use Symfony\Component\EventDispatcher\Event;

class EventFactory {

    public static function createDefaultUserExtendedEvent(UserEvent $event = null) {
        if (!$event)
            $event = new UserEvent();
        $event->setUser(UserFactory::getInstance()->getCurrentUser());

        return self::createDefaultEvent($event);
    }

    public static function createDefaultEvent(Event $event) {
        $class = get_class($event);
        $event->setName($class::NAME);

        return $event;
    }
}