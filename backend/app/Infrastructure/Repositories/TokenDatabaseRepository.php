<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\TokenType;

class TokenDatabaseRepository implements TokenRepository
{

    public function find(TokenType $type, string $userId): Token
    {
        // TODO: Implement this
    }

    public function save(Token $token, string $userId): void
    {

    }

    public function delete(TokenType $type, string $userId): void
    {

    }
}