<?php

use Monolog\Logger;

// For configuration of logging
return [
    'logger' => [
        'name' => 'slim-app',
        'level' => Monolog\Logger::DEBUG,
        'path' => __DIR__ . '/../logs/app.log',
    ],
];
