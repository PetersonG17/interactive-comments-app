<?php

namespace App\Oauth\Infrastructure\Factories;

use App\User\Domain\User;
use App\Oauth\Infrastructure\Token;
use App\Oauth\Infrastructure\TokenType;

interface TokenFactory {
    public static function make(TokenType $type, User $user): Token;
}