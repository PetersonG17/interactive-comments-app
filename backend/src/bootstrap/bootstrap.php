<?php

use DI\ContainerBuilder;

require(__DIR__ . '/../vendor/autoload.php');

// Setup the DI container
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../config/services.php');
$container = $containerBuilder->build();

return $container;