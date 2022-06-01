<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;

require_once __DIR__ . '/../vendor/autoload.php';

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
    'host' => 'interactive-comments-app-postgres',
    'database' => 'interactive_comments',
    'port' => '5432',
    'username' => 'postgres',
    'password' => 'secret',
]);

$capsule->setAsGlobal();

// TODO: Finish this:
// https://github.com/illuminate/database/blob/master/Migrations/Migrator.php
// https://github.com/illuminate/database/blob/master/Migrations/DatabaseMigrationRepository.php
$migrationRepo = new DatabaseMigrationRepository($capsule->getDatabaseManager(), 'migration');

if (!$migrationRepo->repositoryExists()) {
    $migrationRepo->createRepository();
}


include_once __DIR__ . '/../routes/routes.php';

$app->run();
