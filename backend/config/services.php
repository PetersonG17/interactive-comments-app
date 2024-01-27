<?php

// This file defines defintions for the Dependancy Injection

use App\Domain\Services\HashingService;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Domain\Interfaces\UserRepository;
use App\Infrastructure\Queries\Users\GetMultipleUsersQuery;
use App\Infrastructure\Queries\Users\GetSingleUserQuery;
use App\Infrastructure\Services\Md5HashingService;
use App\Infrastructure\Repositories\UserDatabaseRepository;
use JohnPetersonG17\OAuthTokenManagement\HashingAlgorithm;
use JohnPetersonG17\OAuthTokenManagement\Persistance\Driver;
use JohnPetersonG17\OAuthTokenManagement\Config;
use JohnPetersonG17\OAuthTokenManagement\AuthorizationGate;

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

// Setup oauth gate
$oauthConfig = new Config(
    [
        'issuer' => 'http://localhost:8080', // TODO: Make this configurable via env
        'key' => '210e5909-7b0b-4524-9db5-c89faec4896b', // TODO: Make this configurable via env
        'hashing_algorithm' => HashingAlgorithm::HS256,
        'access_token_expiration' => 30,
        'refresh_token_expiration' => 60,
        'persistance_driver' => Driver::Redis,
        'redis' => [
            'parameters' => [
                'host' => $config['caches']['redis']['host'],
                'port' => $config['caches']['redis']['port'],
            ]
        ]
    ]
);

$oauthGate = new AuthorizationGate($oauthConfig);

return [
    Capsule::class => $capsule,
    \Predis\Client::class => $predisClient,
    UserRepository::class => new UserDatabaseRepository($capsule),
    HashingService::class => new Md5HashingService(),
    Faker\Generator::class => $faker,
    GetSingleUserQuery::class => new GetSingleUserQuery($capsule),
    GetMultipleUsersQuery::class => new GetMultipleUsersQuery($capsule),
    AuthorizationGate::class => $oauthGate,
];
