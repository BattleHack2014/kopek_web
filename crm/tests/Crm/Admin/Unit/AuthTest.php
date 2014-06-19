<?php
namespace Crm\Tests\Admin\Unit;

use Crm\Logic\Admin\Report;

use \Crm\Test\LibraryTestCase;
use \Crm\Logic\Logic;
use \Crm\Model\Statistic\Handler\Handler;

require_once __DIR__ . '/../../../../routing/as_lib.php';

class AuthTest extends LibraryTestCase
{
    private $report = null;

    public function setUp() {
        $this->addTestUser();
    }

    public function testLogin() {
    }

    public function testLoginFb() {
    }

    private function addTestUser() {
        $gender = array('men', 'women', 'unknown');

        for ($i = 1; $i < 100; $i++) {
            $gen = $gender[$i % 3];
            Logic::getDbWriter()->executeQuery("
                INSERT IGNORE INTO `imhonet`.`promo_campaign_user` (`id`, `campaign_id`, `brand_user_id`, `imhonet_user_id`, `user_key`, `name`, `is_active`, `contacted_at`, `created_at`, `gender`)
                VALUES ('".$i."', '".$i."', '".$i."', '".$i."', 'some user key', 'John Galt', '1', '2013-03-01 00:00:00', '2013-03-07 00:00:00', '".$gen."');
            ");
        }
    }
}