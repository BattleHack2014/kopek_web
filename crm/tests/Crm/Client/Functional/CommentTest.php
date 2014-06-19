<?php
namespace Crm\Tests\Admin\Functional;

use Crm\Logic\Client\Comment;

use \Crm\Test\LibraryTestCase;
use \Crm\Logic\Logic;

require_once __DIR__ . '/../../../../routing/as_lib.php';

class CommentTest extends LibraryTestCase
{

    public function testActionGet()
    {
        $logic = new Comment();
        $content = $logic->execute('add', array(
            Comment::PARAM_COMMENT_TEXT => 'phpunit: defaultComment',
        ));

        $this->assertCorrectOutputFormat($content);
        $this->assertTrue($content[Logic::OUTPUT_STATUS] == Logic::STATUS_OK);
    }
}