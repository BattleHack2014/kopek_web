<?php
namespace Crm\Tests\Admin\Unit;

use Crm\Model\Statistic\Event\LoginEvent;

use Crm\Logic\Logic;

use Ers\EventParser;

use Crm\Test\LibraryTestCase;

use Crm\Logic\Client\Auth;
use Ers\UniqueUserEvents;

require_once __DIR__ . '/../../../routing/as_lib.php';

class UniqueUserEventsTest extends LibraryTestCase
{

    public function setUp() {
        $this->addTestData();
    }

    public function testSave() {
        $object = UniqueUserEvents::getInstance();
        $events = array();
        for($i = 1; $i < 31; $i++) {
            $events[$i] = array(
                EventParser::short('event', Auth::EVENT_LOGIN) => array(
                    'd' => date('Y-m-d'),
                    1 => EventParser::shortExt(array(1 => LoginEvent::SOCIAL_FB)),
                ),
            );
        }

        $this->setPrivateProperty($object, '_events', $events);

        $object->save();
    }

    private function addTestData() {
        Logic::getDbWriter()->executeQuery("
            INSERT IGNORE INTO `stat_unique_user_events` (`user_id`, `last_events`)
            VALUES ('1', '{}');
        ");
    }
}