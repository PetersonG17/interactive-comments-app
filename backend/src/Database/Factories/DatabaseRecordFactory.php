<?php

namespace Database\Factories;

use App\Shared\Domain\Entity;
use Faker\Generator as Faker;
use Illuminate\Database\Capsule\Manager as Capsule;

abstract class DatabaseRecordFactory {

    protected Capsule $database;
    protected Faker $faker;

    public function __construct(Capsule $database, Faker $faker)
    {
        $this->database = $database;
        $this->faker = $faker;
    }

    abstract public function make(array $overrides = []): Entity;

    abstract public function create(array $overrides = []): Entity;
}