<?php
namespace Crm\Tests\Admin\Functional;

use Crm\Logic\Admin\Report;

use \Crm\Test\LibraryTestCase;
use \Crm\Logic\Logic;

require_once __DIR__ . '/../../../../routing/as_lib.php';

class ReportTest extends LibraryTestCase
{
    public function setUp() {
        $this->addTestReports();
        $this->addTestReportCounters();
        $this->addTestReportCountersValues();
    }

    public function testActionGet()
    {
        $logic = new Report();
        $content = $logic->execute('get', array(
            Report::PARAM_FROM_DATE => '2013-02-01',
            Report::PARAM_TO_DATE => '2013-02-10',
            Report::PARAM_GRANULARITY => \Crm\Model\Statistic\Report::GRANULARITY_DAY,
            Report::PARAM_REPORT_ID => 1,
        ));

        $this->assertCorrectOutputFormat($content);
        $this->assertTrue($content[Logic::OUTPUT_STATUS]);
    }
}