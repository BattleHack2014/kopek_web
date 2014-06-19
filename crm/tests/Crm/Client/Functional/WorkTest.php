<?php
namespace Crm\Tests\Admin\Functional;

use Crm\Logic\Client\Work;

use \Crm\Test\LibraryTestCase;
use \Crm\Logic\Logic;

require_once __DIR__ . '/../../../../routing/as_lib.php';

class WorkTest extends LibraryTestCase
{

    public function testActionGet()
    {
        $logic = new Work();
        $content = $logic->execute('add', array());

        $this->assertCorrectOutputFormat($content);
        $this->assertTrue($content[Logic::OUTPUT_STATUS] == Logic::STATUS_OK);
    }
}