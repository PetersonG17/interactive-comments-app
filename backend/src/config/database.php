<?php

// Database configuration
return  [
    'databases' => [
        'postgres' => [
            'password' => getenv('DATABASE_PASSWORD'),
            'username' => getenv('DATABASE_USER'),
            'database' => getenv('DATABASE_DB'),
            'host' => getenv('DATABASE_HOST'),
            'port' => getenv('DATABASE_PORT'),
        ]
    ]
];
