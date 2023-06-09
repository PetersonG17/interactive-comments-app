<?php

use Slim\Factory\AppFactory;

$container = require_once 'bootstrap.php';

// Create the App
AppFactory::setContainer($container);
$app = AppFactory::create();
$app->add(new Zeuxisoo\Whoops\Slim\WhoopsMiddleware([
    'enable' => true,
    'editor' => 'vscode',
    'title'  => 'Error Exception',
]));

$app->addBodyParsingMiddleware();

include_once __DIR__ . '/../routes/routes.php';

// TODO: Add error handlers....
// https://www.slimframework.com/docs/v4/middleware/error-handling.html

$app->run();
