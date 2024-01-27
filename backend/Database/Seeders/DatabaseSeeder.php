<?php

namespace Database\Seeders;

use Database\Factories\CommentFactory;
use Database\Factories\UserFactory;

class DatabaseSeeder {

    private const NUM_USERS = 10;
    private const NUM_COMMENTS = 50;

    private static $container;

    private static UserFactory $userFactory;
    private static CommentFactory $commentFactory;

    public static function setContainer($container): void
    {
        self::$container = $container;
    }

    public static function seed(): void
    {
        self::setFactories();

        echo "\nSeeding database records...\n";

        self::seedUsers();
        self::seedComments();

        echo "\nDatabase seeding completed successfully.\n";
    }

    private static function setFactories(): void
    {
        self::$userFactory = self::$container->get(UserFactory::class);
        self::$commentFactory = self::$container->get(CommentFactory::class);
    }

    private static function seedUsers(): void
    {
        for($i = 0; $i < self::NUM_USERS; $i++) {
            self::$userFactory->create();
        }

        echo "\nSeeded " . self::NUM_USERS . " Users successfully.\n";
    }

    private static function seedComments(): void
    {
        for($i = 0; $i < self::NUM_COMMENTS; $i++) {
            self::$commentFactory->create();
        }

        echo "\nSeeded " . self::NUM_COMMENTS . " Comments successfully.\n";
    }
}

