<?php
namespace Crm\Tests\Admin\Unit;

use Ers\Reader\Handler\Register;

use Crm\Model\User\User;

use Crm\Model\Statistic\Event\RegisterEvent;

use Crm\Logic\Admin\Report;

use \Crm\Test\LibraryTestCase;
use \Crm\Logic\Logic;
use \Crm\Model\Statistic\Handler\Handler;

require_once __DIR__ . '/../../../../routing/as_lib.php';

class UserCollectionTest extends LibraryTestCase
{

    public function setUp() {
    }

    public function test() {
        $this->report = new \Crm\Model\Statistic\Report(2);
        $this->report->setHandlerData('2013-01-05', '2013-02-10', Handler::GRANULARITY_MONTH);

        $result = $this->report->load();
        $this->assertTrue(is_array($result));
        $should_be = array(
                array("Период (накопительно)", "FB", "VK", "OK", "Всего"),
                array("2013-01-01 - 2013-01-31", 10, 10, 10, 30),
        );

        $this->assertTrue(serialize($result) == serialize($should_be));
    }
}