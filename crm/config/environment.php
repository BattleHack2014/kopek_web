<?php

// Условие определения текущего окружения

if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'imhocrm.imhonet.org')
    define('ENV', 'test');

if (!defined('ENV')) define('ENV', 'dev');

if (!defined('ROOT_PATH')) define('ROOT_PATH', realpath(__DIR__ . '/../'));

require_once ROOT_PATH.'/vendor/autoload.php';
