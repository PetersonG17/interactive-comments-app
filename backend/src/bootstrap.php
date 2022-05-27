<?php

use DI\Container;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

include __DIR__ . '/routes/routes.php';

$app->run();
