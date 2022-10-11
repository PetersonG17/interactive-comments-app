<?php

namespace App\User\Domain\Services;

use App\User\Domain\ValueObjects\HashedPassword;

// TODO: Do we need this interface?
interface HashingService
{
    public static function hash(string $password): HashedPassword;
}