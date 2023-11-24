<?php

namespace App\Infrastructure\Factories;

use App\Domain\User;
use App\Infrastructure\Token;

interface TokenFactory {
    public static function make(string $tokenClass, User $user): Token;
}