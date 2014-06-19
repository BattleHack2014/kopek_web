<?php
namespace Crm\Tests\Library;

use \Crm\Test\LibraryTestCase;
use \Crm\Logic\Admin\Moderate;
use \Crm\Logic\Logic;

require_once __DIR__.'/../../../../vendor/autoload.php';

class ModerateTest extends LibraryTestCase
{
    public function setUp() {
        if (!defined('ENV')) define('ENV', 'dev');
        $this->addTestComment(1);
    }

    public function testActionApprove()
    {
        // Approve comment with id = 1
        $logic = new Moderate();
        $content = $logic->execute('approve', array(
            Moderate::PARAM_PROMO_CAMPAIGN_USER_OBJECT_ID => 1,
        ));

        $this->assertCorrectOutputFormat($content);
        $this->assertTrue($content[Logic::OUTPUT_STATUS]);
    }

    public function testActionReject()
    {
        $logic = new Moderate();
        $content = $logic->execute('reject', array(
            Moderate::PARAM_PROMO_CAMPAIGN_USER_OBJECT_ID => 1,
        ));

        $this->assertCorrectOutputFormat($content);
        $this->assertTrue($content[Logic::OUTPUT_STATUS]);
    }
}