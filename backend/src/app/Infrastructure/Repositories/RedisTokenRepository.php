<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Token;
use \Predis\Client;

class RedisTokenRepository implements TokenRepository {

    private Client $client;

    public function __construct(Client $client) 
    {
        $this->client = $client;
    }

    public function find(int $userId): Token 
    {
        $result = $this->client->get("token-" . $userId);

        return Token::fromString($result);
    }

    public function save(Token $token): void 
    {
         // TODO: Implement this
    }
}