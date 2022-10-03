<?php

namespace App\Oauth\Domain;

interface TokenRepository {

    public function find(int $userId): Token;

    public function save(Token $token): void;
}