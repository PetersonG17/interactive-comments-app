<?php

// This file defines defintions for the Dependancy Injection

use Illuminate\Database\Capsule\Manager as Capsule;
use App\User\Domain\UserRepository;
use App\User\Infrastructure\UserDatabaseRepository;

$capsule = new Capsule();
$config = include 'database.php';
$config = $config['databases']['postgres'];
$capsule->addConnection(
    [
        'driver' => 'pgsql',
        'host' => $config['host'],
        'database' => $config['database'],
        'port' => $config['port'],
        'username' => $config['username'],
        'password' => $config['password'],
    ]
);
$capsule->setAsGlobal();

return [
    Capsule::class => $capsule,
    UserRepository::class => new UserDatabaseRepository($capsule),
];
