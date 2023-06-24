<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;

class DatabaseSeeder {

    private const NUM_RECORDS = 10;

    private static $container;

    public static function setContainer($container): void
    {
        self::$container = $container;
    }

    public static function seed(): void {

        $userFactory = self::$container->get(UserFactory::class);

        for($i = 0; $i < self::NUM_RECORDS; $i++) {
            $userFactory->create();
        }

        echo "\nSeeded " . self::NUM_RECORDS . " successfully.\n";
    }
}

