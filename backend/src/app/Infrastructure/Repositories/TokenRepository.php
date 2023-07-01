<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Token;

interface TokenRepository {

    public function find(int $userId): Token;

    public function save(Token $token): void;
}