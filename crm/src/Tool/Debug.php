<?php

/**
 * @author LapikovVA
 *
 * Замена var_dump
 *
 * @method void general
 * @method void performance
 * @method void cron
 * @method void mysql
 * @method void ka
 * @method void mt
 * @method void forum
 * @method void debug
 * @method void error
 */
class Debug
{
    const LOG_GENERAL = 'general';
    const LOG_PERFORMANCE = 'performance';
    const LOG_CRON = 'cron';
    const LOG_MYSQL = 'mysql';
    const LOG_KA = 'ka';
    const LOG_MT = 'mt';
    const LOG_FORUM = 'forum';
    const LOG_DEBUG = 'debug';
    const LOG_ERROR = 'error';

    const LOG_LEVEL_DEBUG = 'debug';
    const LOG_LEVEL_INFO = 'info';
    const LOG_LEVEL_ERROR = 'error';

    const PROFILER_MEMCACHE = 'MC';

    private $enabled = true;
    private $isFixAppage = false;
    private $isExit = false;
    private $isHumanReadableArgs = false;
    private $isForced = false;
    private $isKillCache = false;
    private $isProxy = false;
    private $proxy = '127.0.0.1:1080';
    private $enableV2 = false;

    private $profilerList = array();
    private $logList = array();

    public function __construct()
    {
        if (!empty($_SERVER['HTTP_DEBUG_MODE']))
            $this->enabled = true;
        if (!empty($_SERVER['HTTP_DEBUG_MODE_FIX_APPAGES']))
            $this->isFixAppage = true;
        if (!empty($_SERVER['HTTP_DEBUG_MODE_KILL_CACHE']))
            $this->isKillCache = true;
        if (!empty($_SERVER['HTTP_DEBUG_MODE_V2']))
            $this->enableV2 = true;

        if (!empty($_SERVER['HTTP_DEBUG_MODE_PROXY'])) {
        	$this->isProxy = true;
        	$this->proxy = $_SERVER['HTTP_DEBUG_MODE_PROXY'];
        }
    }


    public function isV2Enabled() {
        return $this->enableV2;
    }

    public function profiler($tab, $message) {
        $this->profilerList[$tab][] = $message;
    }

    public function getProfilerList($tab) {
        return $this->profilerList[$tab];
    }

    public function getLogList() {
        return $this->logList;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function isKillCache()
    {
        return $this->isKillCache;
    }

    public function isProxy()
    {
    	return $this->isProxy;
    }

    public function getProxy(){
    	return $this->proxy;
    }

    public function force()
    {
        $this->enabled = true;
        $this->isForced = true;
        return $this;
    }

    public function isFixAppage()
    {
        return $this->isFixAppage;
    }

    public function log($message, $logName = self::LOG_GENERAL, $level = self::LOG_LEVEL_ERROR)
    {
        if ($logName == self::LOG_PERFORMANCE) {
            $this->logList[] = $this->prepareMessage($message);
        }

        if (!$this->enabled)
            return false;
        $fileExtension = 'php';

        switch ($logName) {
            case self::LOG_MYSQL:
                $fileExtension = 'sql';
                break;
        }

        if (strstr($logName, '/') === false)
            $logName .= '/';

        $handler = fopen('ff', 'a');
        fwrite($handler, $this->prepareMessage($message));
    }

    private function prepareMessage($message)
    {
        $message = (is_string($message)) ? $message : print_r($message, 1);
        if (!empty($_SERVER['HTTP_DEBUG_USER'])) {
            $message = $_SERVER['HTTP_DEBUG_USER'].' '.$message;
        }
        return $message;
    }

    public function __call($method, $args)
    {
        if (!$this->enabled)
            return false;
        switch ($method) {
            case self::LOG_GENERAL:
            case self::LOG_PERFORMANCE:
            case self::LOG_CRON:
            case self::LOG_MYSQL:
            case self::LOG_KA:
            case self::LOG_MT:
            case self::LOG_FORUM:
            case self::LOG_ERROR:
            case self::LOG_DEBUG:
                // add logName to args
                array_push($args, $method);
                // if message exists
                if (!empty($args[1])) {
                    call_user_func_array(array($this, 'log'), $args);
                }
                break;
        }

        if ($this->isForced) {
            if (empty($_SERVER['HTTP_DEBUG_MODE']))
                $this->enabled = false;
            $this->isForced = false;
        }
    }

    public function setExit($isExit)
    {
        $this->isExit = $isExit;
    }

    public function setHumanReadableArgs($isHumanReadableArgs)
    {
        $this->isHumanReadableArgs = $isHumanReadableArgs;
    }

    public function dd($mVariable)
    {
        if (!$this->enabled)
            return false;

        $this->html_wrapper(print_r($mVariable, 1));

        if ($this->isExit)
            exit();
    }

    function dc($mVariable)
    {
        echo '=====================
';
        echo print_r($mVariable, 1);
        echo '=====================
';
        if ($this->isExit)
            exit();
    }

    function tt($iLevel = 8)
    {
        if (!$this->enabled)
            return false;
        $this->html_wrapper($this->get_trace($iLevel));

        if ($this->isExit)
            exit();
    }

    function ff($mVariable)
    {
        if (!$this->enabled)
            return false;
        $call = $this->get_call_place(1);
        $sContent = print_r($mVariable, 1) . PHP_EOL . '----'. getmypid() .'----' . '--------------' . PHP_EOL;
        $sContent .= $call['file'] . ' (' . $call['line'] . ')     ' . $call['object'] . $call['function'] . '(' . $call['args'] . ')' . PHP_EOL;

        $this->log($sContent, self::LOG_DEBUG);
        if ($this->isExit)
            exit();
    }

    function ft($iLevel = 8)
    {
        if (!$this->enabled)
            return false;

        $this->log($this->get_trace($iLevel, false), self::LOG_DEBUG);

        if ($this->isExit)
            exit();
    }

    private function html_wrapper($content)
    {
        $call = $this->get_call_place();

        $sHead = '<table cellspacing="0" cellpadding="0" border="0" width="100%" style="position:relative;z-index:9999;margin-top:10px;font-family:sans-serif;background-color:white;font-size:12px;padding:5px;border:3px dashed #ff0000;"><tr><td><table cellspacing="1" cellpadding="0" border="0" width="100%" style="font-family:sans-serif;background-color:white;font-size:12px;"><tr><td width="100%" style="color:#000000;font-weight:bold;font-size:12px;border:1px solid #cccccc;background-color:#ffaa00;">';
        $sHead .= $call['file'] . ' (' . $call['line'] . ') &nbsp;&nbsp;&nbsp;&nbsp;' . $call['object'] . $call['function'] . '(' . $call['args'] . ')';
        $sHead .= '</td></tr><tr><td width="100%" style="border:solid 1px #cccccc;color:black;"><pre>' . PHP_EOL;
        echo $sHead;
        echo $content;
        $sFoot = PHP_EOL . '</pre></td></tr></table></td></tr></table>';
        echo $sFoot;
    }

    private function get_trace($iLevel, $withHtml = true)
    {
        $trace = debug_backtrace();
        array_shift($trace);
        array_shift($trace);
        $sContent = '';
        foreach ($trace as $key => $level) {
            if (!$iLevel--)
                break;
            if ($key && $withHtml)
                $sContent .= '<hr size="1"/>';
            $line = isset($level['line']) ? $level['line'] : "";
            $file = isset($level['file']) ? $level['file'] : "";
            $function = isset($level['function']) ? $level['function'] : '';
            $object = isset($level['object']) ? get_class($level['object']) . ' :: ' : '';
            $args = $this->parseArgs($level['args']);
            $sContent .= $file . ' (' . $line . ')     ' . $object . $function . '(' . $args . ')' . PHP_EOL;
        }
        return $sContent;
    }

    private function get_call_place($offset = 0)
    {
        $result = array();
        $trace = debug_backtrace();
        $result['line'] = $trace[3 - $offset]['line'];
//         $result['file'] = str_replace($prefix, '', $trace[1]['file']);
        $result['file'] = $trace[3 - $offset]['file'];
        $result['function'] = isset($trace[4 - $offset]['function']) ? $trace[4 - $offset]['function'] : '';
        $result['object'] = isset($trace[4 - $offset]['object']) ? get_class($trace[4 - $offset]['object']) . ' :: ' : '';
        $result['args'] = $this->parseArgs(isset($trace[4 - $offset]['args']) ? $trace[4 - $offset]['args'] : '');
        return $result;
    }

    private function parseArgs($args)
    {
        if (empty($args))
            return '';
        $result = '';
        foreach ($args as $key => $arg) {
            $result .= (($key) ? ',' : '');
            if ($this->isHumanReadableArgs && is_array($arg))
                $result .= print_r($arg, true);
            else if (is_object($arg)) {
                if ($this->isHumanReadableArgs)
                    $result .= print_r($arg, true);
                else
                    $result .= get_class($arg);
            }
            else
                $result .= $arg;
        }
        return $result;
    }
}

if (!function_exists('dd')) {

    function dd($mVariable, $bExit = false, $bHumanReadableArgs = false)
    {
        $debug = new Debug();
        $debug->setHumanReadableArgs($bHumanReadableArgs);
        $debug->setExit($bExit);
        $debug->dd($mVariable);
    }

    function dc($mVariable, $bExit = false, $bHumanReadableArgs = false)
    {
        $debug = new Debug();
        $debug->setHumanReadableArgs($bHumanReadableArgs);
        $debug->setExit($bExit);
        $debug->dc($mVariable);
    }

    function ff($mVariable, $bExit = false, $bHumanReadableArgs = false)
    {
        $debug = new Debug();
        $debug->setHumanReadableArgs($bHumanReadableArgs);
        $debug->setExit($bExit);
        $debug->ff($mVariable);
    }

    function tt($mVariable, $bExit = false, $bHumanReadableArgs = false)
    {
        $debug = new Debug();
        $debug->setHumanReadableArgs($bHumanReadableArgs);
        $debug->setExit($bExit);
        $debug->tt($mVariable);
    }
}