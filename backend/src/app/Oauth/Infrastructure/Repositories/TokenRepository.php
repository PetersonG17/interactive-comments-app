<?php

namespace App\Oauth\Infrastructure\Repositories;

interface TokenRepository {

    public function find(int $userId): Token;

    public function save(Token $token): void;
}