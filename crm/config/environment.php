<?php

// Условие определения текущего окружения

if (!defined('ENV')) define('ENV', 'dev');

if (!defined('ROOT_PATH')) define('ROOT_PATH', realpath(__DIR__ . '/../'));

require_once ROOT_PATH.'/vendor/autoload.php';
