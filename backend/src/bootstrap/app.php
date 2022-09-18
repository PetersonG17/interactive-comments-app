<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

// TODO: Clean up this file...

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions('../config/services.php');
$container = $containerBuilder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->add(new Zeuxisoo\Whoops\Slim\WhoopsMiddleware([
    'enable' => true,
    'editor' => 'vscode',
    'title'  => 'Error Exception',
]));

include_once __DIR__ . '/../routes/routes.php';

$app->run();
