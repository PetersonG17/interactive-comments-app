<?php

namespace App\User\Infrastructure\Services;

use App\User\Domain\Services\HashingService;
use App\User\Domain\ValueObjects\HashedPassword;

class Md5HashingService implements HashingService
{
    private const SALT = 'S3cur3V@lu3!';

    public static function hash(string $password): HashedPassword
    {
        return new HashedPassword(password_hash(self::SALT . $password, PASSWORD_DEFAULT));
    }
}