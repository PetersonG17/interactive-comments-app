<?php

use Database\Seeders\DatabaseSeeder;

$container = require(__DIR__ . '/../bootstrap/bootstrap.php');

DatabaseSeeder::setContainer($container);
DatabaseSeeder::seed();