<?php

use Symfony\Component\HttpFoundation\Response;
use \Crm\Logic\Logic;
use \Crm\Logic\Admin\Auth;

define('AREA', 'client');

require_once __DIR__.'/../crm/config/environment.php';
require_once ROOT_PATH.'/src/Tool/Debug.php';

$app = require_once __DIR__ . '/../crm/routing/html.php';

$app->run();