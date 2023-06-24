<?php

namespace App\Shared\Infrastructure;

use Ramsey\Uuid\Uuid;

class UuidGenerator {

    public static function make(): string
    {
        return Uuid::uuid4()->toString();
    }
}