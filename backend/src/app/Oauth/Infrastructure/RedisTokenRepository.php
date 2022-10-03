<?php

namespace App\Oauth\Infrastructure;

use App\Oauth\Domain\Token;
use App\Oauth\Domain\TokenRepository;
use \Predis\Client;

class RedisTokenRepository implements TokenRepository {

    private Client $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function find(int $userId): Token {

    }

    public function save(Token $token): void {
        
    }
}