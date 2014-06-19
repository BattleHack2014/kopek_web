<?php
namespace Crm\Tests\Admin\Unit;

use Crm\Logic\Logic;

use Crm\Model\Statistic\Event\LoginEvent;

use Ers\Reader\AbstractReader;

use Crm\Test\LibraryTestCase;

require_once __DIR__ . '/../../../routing/as_lib.php';

class AbstractReaderTest extends LibraryTestCase
{

    public function setUp() {
        Logic::getDbWriter()->executeQuery("truncate stat_report_register;");
        Logic::getDbWriter()->executeQuery("truncate stat_unique_user_events;");
    }

    public function testGetWeek() {
        $stub = $this->getMockForAbstractClass('Ers\Reader\AbstractReader', array(array('date' => '2013-03-14')));
        $should_be = array(
            0 => '2013-03-11',
            1 => '2013-03-12',
            2 => '2013-03-13',
            3 => '2013-03-14',
        );

        $this->assertTrue(serialize($stub->getWeek()) == serialize($should_be));

        $stub = $this->getMockForAbstractClass('Ers\Reader\AbstractReader', array(array('date' => '2013-03-17')));
        $should_be = array(
            '2013-03-11',
            '2013-03-12',
            '2013-03-13',
            '2013-03-14',
            '2013-03-15',
            '2013-03-16',
            '2013-03-17',
        );

        $this->assertTrue(serialize($stub->getWeek()) == serialize($should_be));

        $stub = $this->getMockForAbstractClass('Ers\Reader\AbstractReader', array(array('date' => '2013-03-18')));
        $should_be = array(
                '2013-03-18',
        );

        $this->assertTrue(serialize($stub->getWeek()) == serialize($should_be));
    }

    public function testGetMonth() {
        $stub = $this->getMockForAbstractClass('Ers\Reader\AbstractReader', array(array('date' => '2013-03-07')));
        $should_be = array(
            '2013-03-01',
            '2013-03-02',
            '2013-03-03',
            '2013-03-04',
            '2013-03-05',
            '2013-03-06',
            '2013-03-07',
        );

        $this->assertTrue(serialize($stub->getMonth()) == serialize($should_be));

        $stub = $this->getMockForAbstractClass('Ers\Reader\AbstractReader', array(array('date' => '2013-03-01')));
        $should_be = array(
            '2013-03-01',
        );

        $this->assertTrue(serialize($stub->getMonth()) == serialize($should_be));
    }
}