<?php
namespace Crm\Tests\Admin\Functional;

use Crm\Logic\Client\Friend;

use \Crm\Test\LibraryTestCase;
use \Crm\Logic\Logic;

require_once __DIR__ . '/../../../../routing/as_lib.php';

class FriendTest extends LibraryTestCase
{

    public function testActionGet()
    {
        $logic = new Friend();
        $content = $logic->execute('add', array());

        $this->assertCorrectOutputFormat($content);
        $this->assertTrue($content[Logic::OUTPUT_STATUS] == Logic::STATUS_OK);
    }
}