<?php

namespace App\Infrastructure\Services;

use App\Domain\Services\HashingService;
use App\Domain\ValueObjects\HashedPassword;

class Md5HashingService implements HashingService
{
    private const SALT = 'S3cur3V@lu3!';

    public static function hash(string $password): HashedPassword
    {
        return new HashedPassword(md5(self::SALT . $password));
    }
}