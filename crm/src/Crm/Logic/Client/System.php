<?php
namespace Crm\Logic\Client;

use Symfony\Component\Console\Input\ArgvInput;

use Ers\Console\Console;

use Ers\Ers;

use Crm\Model\Statistic\Handler\Handler;

use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class System extends Logic {

    public function actionCli() {
        $_SERVER['argv'] = explode(' ', self::getSystemParam(self::PARAM_SYSTEM_COMMAND));

        Console::run();
        exit;
    }

    /**
     * https://developers.facebook.com/docs/javascript/gettingstarted/#channel
     */
    public function actionChannelFile() {
        $cache_expire = 60*60*24*32;
        header("Pragma: public");
        header("Cache-Control: max-age=".$cache_expire);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
    }
}