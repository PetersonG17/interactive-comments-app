<?php

namespace App\Oauth\Infrastructure\Repositories;

use App\Oauth\Infrastructure\Token;
interface TokenRepository {

    public function find(int $userId): Token;

    public function save(Token $token): void;
}