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

class ReportTest extends LibraryTestCase
{
    private $report = null;

    public function setUp() {
        $this->addTestReports();
        //$this->addTestReport(1);
        //$this->addTestReport(2);
        //$this->addTestReport(3);
        //$this->addTestReport(4);
    }

    public function testLoadForDay() {
        $this->report = new \Crm\Model\Statistic\Report(1);
        $this->report->setHandlerData('2013-01-05', '2013-02-10', Handler::GRANULARITY_DAY);

        // For day
        $result = $this->report->load();
        $should_be = array(
            array('Пол', 'Количество'),
            array('Мужчины', 10),
            array('Женщины', 10),
        );

        $this->assertTrue(serialize($result) == serialize($should_be));
    }

    public function testLoadForWeek() {
        $this->report = new \Crm\Model\Statistic\Report(2);
        $this->report->setHandlerData('2013-01-05', '2013-02-10', Handler::GRANULARITY_WEEK);

        $result = $this->report->load();
        $should_be = array(
            array("Период (накопительно)", "FB", "VK", "OK", "Всего"),
            array("2012-12-31 - 2013-01-06", 10,10,10,30),
            array("2013-01-07 - 2013-01-13", 10,10,10,30),
            array("2013-01-14 - 2013-01-20", 10,10,10,30),
            array("2013-01-21 - 2013-01-27", 10,10,10,30),
            array("2013-01-28 - 2013-02-03", 10,10,10,30),
            array("2013-02-04 - 2013-02-10", 10,10,10,30),
        );

        $this->assertTrue(serialize($result) == serialize($should_be));
    }

    public function testLoadForMonth() {
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

    public function testRegisterReport() {
        $this->report = new \Crm\Model\Statistic\Report(3);
        $this->report->setHandlerData('2013-01-01', '2013-01-05', Handler::GRANULARITY_DAY);

        $result = $this->report->load();
        $this->assertTrue(is_array($result));
        $should_be = array(
                array("Период (накопительно)", "Новые", "Всего"),
                array("2013-01-01", 10, 10),
                array("2013-01-02", 10, 20),
                array("2013-01-03", 10, 30),
                array("2013-01-04", 10, 40),
                array("2013-01-05", 10, 50),
        );

        $this->assertTrue(serialize($result) == serialize($should_be));
    }

    private function addTestReports() {

        $statm = Logic::getDbWriter()->prepare("
            INSERT IGNORE INTO `stat_report` (`id`, `handler`, `title`, `campaign_id`)
                VALUES
                ('1', 'UniqueSex', 'Unique sex', 0),
                ('2', 'UniqueSocialNetwork', 'Auth via Social Networks', 0),
                ('3', 'Register', 'Register', 0),
                ('4', 'UniqueAge', 'UniqueAge', 0),
                ('5', 'UniqueActivity', 'UniqueActivity', 0),
                ('6', 'UniqueWorks', 'UniqueWorks', 0),
                ('7', 'UniqueVotes', 'UniqueVotes', 0),
                ('8', 'UniqueCodes', 'UniqueCodes', 0),
                ('9', 'TestResults', 'TestResults', 0),
                ('10', 'WorksStatuses', 'WorksStatuses', 0),
                ('11', 'WorksRatings', 'WorksRatings', 0),
                ('12', 'InvitationsStatuses', 'InvitationsStatuses', 0),
                ('13', 'CodesStatuses', 'CodesStatuses', 0),
                ('14', 'ContentLikesSocialNetworks', 'ContentLikesSocialNetworks', 0),
                ('15', 'WinnersByPrize', 'WinnersByPrize', 0),
                ('16', 'WorksCommentsStatuses', 'WorksCommentsStatuses', 0),
                ('17', 'RejectionRequests', 'RejectionRequests', 0)"
        );
        $statm->execute();
    }

    private function addTestReport($report_id) {
        $counter = function() { return 10; }; // Value for unit testing
        //$counter = function() { return rand(10,100); }; // Value for generating random values

        $start = new \DateTime('2013-01-01');
        switch ($report_id) {
            case 1:
                $sex = array(
                    'Мужчины',
                    'Женщины'
                );
                for ($i = 0; $i < 60; $i++) {
                    foreach ($sex as $param1) {
                        Logic::getDbWriter()->executeQuery("INSERT IGNORE INTO `stat_report_unique_sex` (`date`, `sex`, `counter`)
                                          VALUES ('".$start->format('Y-m-d')."', '".$param1."', '".$counter()."');");
                    }
                    $start->modify('+1 day');
                }
                break;
            case 2:
                $social_network = array(
                    'FB',
                    'VK',
                    'OK'
                );
                for ($i = 0; $i < 60; $i++) {
                    foreach ($social_network as $param1) {
                        Logic::getDbWriter()->executeQuery("INSERT IGNORE INTO `stat_report_unique_social_network` (`date`, `social_network`, `counter`)
                                      VALUES ('".$start->format('Y-m-d')."', '".$param1."', '".$counter()."');");
                    }
                    $start->modify('+1 day');
                }
                $start = new \DateTime('2012-12-30');
                for ($i = 0; $i < 30; $i++) {
                    foreach ($social_network as $param1) {
                        Logic::getDbWriter()->executeQuery("INSERT IGNORE INTO `stat_report_unique_social_network` (`date`, `social_network`, `counter`, `period`)
                                      VALUES ('".$start->format('Y-m-d')."', '".$param1."', '".$counter()."', 'week');");
                    }
                    $start->modify('+7 day');
                }

                $start = new \DateTime('2013-01-01');

                for ($i = 0; $i < 10; $i++) {
                    foreach ($social_network as $param1) {
                        Logic::getDbWriter()->executeQuery("INSERT IGNORE INTO `stat_report_unique_social_network` (`date`, `social_network`, `counter`, `period`)
                                      VALUES ('".$start->format('Y-m-t')."', '".$param1."', '".$counter()."', 'month');");
                    }
                    $start->modify('+1 month');
                }
                break;
            case 3:
                $total = 0;
                for ($i = 0; $i < 60; $i++) {
                    $total += $counter();
                    Logic::getDbWriter()->executeQuery("
                        INSERT IGNORE INTO `stat_report_register` (`date`, `time`, `counter`)
                        VALUES ('".$start->format('Y-m-d')."', '".Register::TIME_NEW."', '".$counter()."');");
                    Logic::getDbWriter()->executeQuery("
                        INSERT IGNORE INTO `stat_report_register` (`date`, `time`, `counter`)
                        VALUES ('".$start->format('Y-m-d')."', '".Register::TIME_TOTAL."', '".$total."');");
                    $start->modify('+1 day');
                }
                break;
            case 4:
                $total = 0;
                $age = array(
                    User::AGE_BEFORE_18,
                    User::AGE_18_24,
                    User::AGE_25_34,
                    User::AGE_35_44,
                    User::AGE_MORE_45
                );
                for ($i = 0; $i < 60; $i++) {
                    foreach ($age as $specific_age) {
                        Logic::getDbWriter()->executeQuery("
                        INSERT IGNORE INTO `stat_report_unique_age` (`date`, `age`, `counter`)
                        VALUES ('".$start->format('Y-m-d')."', '".$specific_age."', '".$counter()."');");
                    }
                    $start->modify('+1 day');
                }
                break;
        }
    }
}