<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ . '/../vendor/autoload.php';

// TODO: Clean up this file so that it only creates the application, it will be called by the console and http kernal

$container = new Container();

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->add(new Zeuxisoo\Whoops\Slim\WhoopsMiddleware([
    'enable' => true,
    'editor' => 'vscode',
    'title'  => 'Error Exception',
]));

// Setup the database -----

$capsule = new Capsule();

// TODO: Load this using config files
$capsule->addConnection([
    'driver' => 'pgsql',
    'host' => 'postgres',
    'database' => 'interactive_comments',
    'port' => '5432',
    'username' => 'postgres',
    'password' => 'secret',
]);
$capsule->setAsGlobal();

include_once __DIR__ . '/../routes/routes.php';

$app->run();
