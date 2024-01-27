<?php

namespace App\Domain\Services;

use App\Domain\ValueObjects\HashedPassword;

// TODO: Do we need this interface?
interface HashingService
{
    public static function hash(string $password): HashedPassword;
}