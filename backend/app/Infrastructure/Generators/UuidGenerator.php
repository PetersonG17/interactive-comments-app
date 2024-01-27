<?php

namespace App\Infrastructure\Generators;

use Ramsey\Uuid\Uuid;

class UuidGenerator {

    public static function make(): string
    {
        return Uuid::uuid4()->toString();
    }
}