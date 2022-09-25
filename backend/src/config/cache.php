<?php

// Cache Configuration
return  [
    'caches' => [
        'redis' => [
            'password' => getenv('REDIS_PASSWORD'),
            'host' => getenv('REDIS_HOST'),
            'port' => getenv('REDIS_PORT'),
        ]
    ]
];
