<?php
namespace Crm\Tests\Admin\Functional;

use Crm\Logic\Client\Auth;

use \Crm\Test\LibraryTestCase;
use \Crm\Logic\Logic;

require_once __DIR__ . '/../../../../routing/as_lib.php';

class AuthTest extends LibraryTestCase
{

    public function testActionGet()
    {
        $logic = new Auth();
        $content = $logic->execute('login', array());

        $this->assertCorrectOutputFormat($content);
        $this->assertTrue($content[Logic::OUTPUT_STATUS] == Logic::STATUS_OK);
    }
}