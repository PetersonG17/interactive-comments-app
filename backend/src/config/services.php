<?php

// This file defines defintions for the Dependancy Injection

use App\Oauth\Infrastructure\Factories\JwtTokenFactory;
use App\Oauth\Infrastructure\Factories\TokenFactory;
use App\Oauth\Infrastructure\Repositories\RedisTokenRepository;
use App\User\Domain\Services\HashingService;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\User\Domain\UserRepository;
use App\User\Infrastructure\Services\Md5HashingService;
use App\User\Infrastructure\UserDatabaseRepository;
use Database\Factories\DatabaseRecordFactory;

// TODO: Clean this up
// Get all config files and create a single config array
$configFiles = scandir(__DIR__);
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

// Faker setup
$faker = Faker\Factory::create();

return [
    Capsule::class => $capsule,
    \Predis\Client::class => $predisClient,
    UserRepository::class => new UserDatabaseRepository($capsule),
    TokenRepository::class => new RedisTokenRepository($predisClient),
    TokenFactory::class => new JwtTokenFactory(),
    HashingService::class => new Md5HashingService(),
    Faker\Generator::class => $faker,
];
