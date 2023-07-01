<?php

namespace App\Infrastructure\Factories;

use App\Domain\User;
use App\Oauth\Infrastructure\Token;
use App\Oauth\Infrastructure\TokenType;

interface TokenFactory {
    public static function make(TokenType $type, User $user): Token;
}