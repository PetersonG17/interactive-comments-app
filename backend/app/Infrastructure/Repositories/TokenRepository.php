<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Token;

interface TokenRepository {

    public function find(string $tokenClass, string $userId): Token;

    public function save(Token $token, string $userId): void;

    public function delete(string $tokenClass, string $userId): void;
}