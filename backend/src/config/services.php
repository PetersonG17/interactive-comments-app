<?php

// This file defines defintions for the Dependancy Injection
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Author\Domain\AuthorRepository;
use App\Author\Infrastructure\AuthorDatabaseRepository;

$capsule = new Capsule();
// TODO: Load this from config file
$capsule->addConnection(
    [
        'driver' => 'pgsql',
        'host' => 'postgres',
        'database' => 'interactive_comments',
        'port' => '5432',
        'username' => 'postgres',
        'password' => 'secret',
    ]
);

return [
    Capsule::class => $capsule,
    AuthorRepository::class => new AuthorDatabaseRepository($capsule)
];
