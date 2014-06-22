<?php
namespace Crm\Logic;

use Symfony\Component\HttpFoundation\Session\Storage\Handler\MemcacheSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

use Tool\Curl;
use Tool\Session;
use Tool\MemcachedTag;
use Silex\Application;
use Symfony\Component\Validator\Validator;
use Symfony\Component\Validator\Validation;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\MemcachedSessionHandler;
use PDO;
use Config\Config;

abstract class Logic {

    private static $config = array();

    /**
     * @var \Symfony\Component\Validator\Validator
     */
    private static $validator = null;

    private static $db = array();

    /**
     * @var EventDispatcher
     */
    private static $event_dispatcher = null;

    /**
     * @var Request
     */
    private static $request = null;

    /**
     * @var \Memcached
     */
    private static $memcached = null;

    /**
     * @var MemcachedTag
     */
    private static $memcachedTag = null;


    /**
     * @var \Symfony\Component\HttpFoundation\Session\Session
     */
    private static $session = null;

    /**
     * @var \Ers\Ers
     */
    private static $ers = null;

    /**
     * @var Curl
     */
    private static $curl = null;

    public function __construct() {
    }

    /**
     * @return Config
     */
    public static function getConfig($file) {
        if (isset(self::$config[$file]))
            return self::$config[$file];

        return self::$config[$file] = Config::createConfig($file);
    }

    /**
     * @return \Symfony\Component\EventDispatcher\EventDispatcher
     */
    public static function getEventDispatcher() {
        if (self::$event_dispatcher === null)
            self::$event_dispatcher = new EventDispatcher();

        return self::$event_dispatcher;
    }

    const DB_DEFAULT = 'db_default';
    const DB_MASTER = 'db_master';
    const DB_SLAVE = 'db_slave';

    /**
     * Получение соединения к общему для всего проекта хранилищу
     *
     * @return \Doctrine\DBAL\Connection
     */
    public static function getDbDefault() {
        return self::getDb(self::DB_DEFAULT);
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public static function getDbReader() {
        return self::getDb(self::DB_SLAVE);
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public static function getDbWriter() {
        return self::getDb(self::DB_MASTER);
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    private static function getDb($connection) {
        if (!defined('ENV'))
            throw new \ErrorException(__METHOD__ . ' :: Please set ENV constant');

        if (isset(self::$db[$connection])) {
            return self::$db[$connection];
        }

        $config = new \Doctrine\DBAL\Configuration();

        // TODO temp code
        //$config->setSQLLogger(new EchoSQLLogger());
        self::$db[$connection] = \Doctrine\DBAL\DriverManager::getConnection(
            self::getConfig('db')->get($connection),
            $config
        );

        return self::$db[$connection];
    }

    /**
     * @return Curl
     */
    public static function getCurl() {
        if (self::$curl)
            return self::$curl;

        return self::$curl = new Curl();
    }


    /**
     * @return \Symfony\Component\Validator\Validator
     */
    public static function getValidator() {
        if (self::$validator === null)
            self::$validator = Validation::createValidator();

        return self::$validator;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public static function getRequest() {
        if (self::$request === null)
            self::$request = Request::createFromGlobals();

        return self::$request;
    }

    /**
     * @return MemcachedTag
     */
    public static function getMemcachedTag() {
        return self::$memcachedTag = new MemcachedTag(self::getMemcached());
    }

    /**
     * @return \Memcached
     */
    public static function getMemcached() {
        if (self::$memcached !== null)
            return self::$memcached;

        if (class_exists('\Memcached')) {
            self::$memcached = new \Memcached();
        } else {
            self::$memcached = new \Memcache();
        }

        foreach (Config::getMemcachedConfig()->get('servers') as $server) {
            self::$memcached->addServer(
                $server['host'],
                $server['port'],
                $server['weight']
            );
        }

        return self::$memcached;
    }

    /**
     * @return \Tool\Session
     */
    public static function getSession() {
        if (self::$session === null) {
            $options = array(
                'prefix' => self::getConfig('session')->get('prefix'),
                'expiretime' => self::getConfig('session')->get('expiretime'),
            );

            if (class_exists('\Memcached'))
                $handler = new MemcachedSessionHandler(self::getMemcached(), $options);
            else
                $handler = new MemcacheSessionHandler(self::getMemcached(), $options);

            $storage = new NativeSessionStorage(array(), $handler);
            if (isset($_SERVER['PHP_SELF']) && strpos($_SERVER['PHP_SELF'], 'phpunit'))
                $storage = new MockArraySessionStorage();
            self::$session = new Session($storage);
            self::$session->start();
        }
        return self::$session;
    }

    /**
     * @return \Ers\Ers
     */
    public static function getErs() {
        if (self::$ers !== null)
            return self::$ers;

        return self::$ers = \Ers\Ers::getInstance();
    }

    private static $_system = array();

    /**
     * Параметр для изменения текущего юзера
     * Необходим для тестирования
     */
    const PARAM_SYSTEM_USER_ID = 'systemUserId';

    const PARAM_SYSTEM_LOGGER_DATE = 'systemLoggerDate';

    const PARAM_SYSTEM_COMMAND = 'systemCommand';

    public static function getSystemParam($param, $default = null) {
        if (isset(self::$_system[$param]))
            return self::$_system[$param];

        return $default;
    }

    // Вызываемое действие
    protected $_action = NULL;

    // Параметры логики
    protected $_param = array();

    /**
     * Не критические сообщения об ошибках
     *
     * @var array
     */
    protected $_message = null;


    /**
     * Путь редиректа
     *
     * @var string
     */
    protected $_redirect = null;

    protected $_status = 200;

    const STATUS_OK = 200;

    const OUTPUT_STATUS = 'status';
    const OUTPUT_RESULT = 'data';
    const OUTPUT_MESSAGE = 'message';
    const OUTPUT_REDIRECT = 'path';

    final public function execute($action, $param) {
        $this->_action = $this->_prepeareMethodName($action);

        //TODO Temp code
        unset($param['XDEBUG_SESSION_START']);
        unset($param['KEY']);

        $this->_param = $param;

        if (!method_exists($this, $this->_action))
            throw new \InvalidArgumentException('Action with name "'.$this->_action.'" is not defined in class "'.$this.'"');

        try {
            $this->_preExecute();

            $result = $this->{$this->_action}();

            $this->_postExecute();
        } catch (\ErrorException $e) {
            return array(
                self::OUTPUT_STATUS => (is_null($e->getCode()) ? 0 : $e->getCode()) ,
                self::OUTPUT_MESSAGE => $e->getMessage(),
                self::OUTPUT_REDIRECT => $this->_redirect,
            );
        }

        return array(
            self::OUTPUT_STATUS => $this->_status,
            self::OUTPUT_RESULT => $result,
            self::OUTPUT_MESSAGE => $this->_message,
            self::OUTPUT_REDIRECT => $this->_redirect,
        );
    }

    public function __toString() {
        return get_class($this);
    }

    protected function _preExecute() {
        // Валидация входных параметров
        $this->_inputValidate();
    }

    protected function _postExecute() {}

    const PARAM_TYPE = 'type'; // Формат возвращаемого контента

    protected $_type = 'json'; // Формат по умолчанию

    protected function _inputValidate() {
        // Устанавливаем системные аргументы
        foreach ($this->_param as $key => $value) {
            if (strpos($key, 'system') === 0) {
                self::$_system[$key] = $value;
                unset($this->_param[$key]);
            }
        }

        // Устанавливаем параметр типа возвращаемого контента, на случай, если от этого зависит работа бизнес-логик
        if (isset($this->_param[self::PARAM_TYPE])) {
            $this->_type = $this->_param[self::PARAM_TYPE];
            unset($this->_param[self::PARAM_TYPE]); // Валидация этого параметра происходит в index.php - еще до инициализации Silex
        }
    }

    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    const STATUS_ALREADY_EXISTS = 601;
    const STATUS_VALIDATION_FAILED = 600;

    protected function error($status_code, $message = null) {
        switch ($status_code) {
            case self::STATUS_FORBIDDEN:
                $this->_redirect = '/login';
                throw new \ErrorException('Forbidden', self::STATUS_FORBIDDEN);

            case self::STATUS_NOT_FOUND:
                throw new \ErrorException(($message) ? $message : 'Not Found', self::STATUS_NOT_FOUND);

            case self::STATUS_VALIDATION_FAILED:
                throw new \ErrorException($message, self::STATUS_VALIDATION_FAILED);

            default:
                throw new \ErrorException('Undefined exception', $status_code);
        }
    }

    protected function _prepeareMethodName($name) {
        $name = str_replace('_', ' ', $name);
        $name = ucwords($name);
        return 'action' . str_replace(' ', '', $name);
    }
}