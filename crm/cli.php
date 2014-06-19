<?php

define('ROOT_PATH', __DIR__ . '/');

require_once ROOT_PATH.'/vendor/autoload.php';

//TODO: Temp code
require_once ROOT_PATH.'/src/Tool/Debug.php';

Ers\Ers::getInstance()->doCli();
