<?php
namespace Crm\Tests\Admin\Functional;

use Crm\Logic\Client\Register;

use \Crm\Test\LibraryTestCase;
use \Crm\Logic\Logic;

require_once __DIR__ . '/../../../../routing/as_lib.php';

class RegisterTest extends LibraryTestCase
{

    public function testActionGet()
    {
        $logic = new Register();
        $content = $logic->execute('register', array());

        $this->assertCorrectOutputFormat($content);
        $this->assertTrue($content[Logic::OUTPUT_STATUS] == Logic::STATUS_OK);
    }
}