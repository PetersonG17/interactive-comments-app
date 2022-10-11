<?php

// This file defines defintions for the Dependancy Injection

use App\Oauth\Infrastructure\Factories\JwtTokenFactory;
use App\Oauth\Infrastructure\Factories\TokenFactory;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\User\Domain\UserRepository;
use App\User\Infrastructure\UserDatabaseRepository;

// TODO: Clean this up
// Get all config files and create a single config array
$configFiles = scandir('../config');
$keysToRemove = ['services.php', '.', '..'];
foreach($keysToRemove as $key) {
    $index = array_search($key, $configFiles);
    unset($configFiles[$index]);
}

$config = [];
foreach($configFiles as $configFile) {
    $config = array_merge($config, include $configFile);
}

// TODO: Interfaces for these...
// Database setup
$capsule = new Capsule();
$capsule->addConnection(
    [
        'driver' => 'pgsql',
        'host' => $config['databases']['postgres']['host'],
        'database' => $config['databases']['postgres']['database'],
        'port' => $config['databases']['postgres']['port'],
        'username' => $config['databases']['postgres']['username'],
        'password' => $config['databases']['postgres']['password'],
    ]
);
$capsule->setAsGlobal();

// Cache setup
$predisClient = new \Predis\Client([
    'scheme' => 'tcp',
    'host'   => $config['caches']['redis']['host'],
    'port'   => $config['caches']['redis']['port'],
    'password'   => $config['caches']['redis']['password'],
]);

return [
    Capsule::class => $capsule,
    \Predis\Client::class => $predisClient,
    UserRepository::class => new UserDatabaseRepository($capsule),
    TokenFactory::class => new JwtTokenFactory()
];
