<?php
namespace Crm\Tests\Admin\Functional;

use Crm\Logic\Client\Like;

use \Crm\Test\LibraryTestCase;
use \Crm\Logic\Logic;

require_once __DIR__ . '/../../../../routing/as_lib.php';

class LikeTest extends LibraryTestCase
{

    public function testActionGet()
    {
        $logic = new Like();
        $content = $logic->execute('add', array(
            'id' => 10,
        ));

        $this->assertCorrectOutputFormat($content);
        $this->assertTrue($content[Logic::OUTPUT_STATUS] == Logic::STATUS_OK);
    }
}