<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\AccessToken;
use App\Infrastructure\Token;
use \Predis\Client;

class RedisTokenRepository implements TokenRepository {

    private Client $client;

    public function __construct(Client $client) 
    {
        $this->client = $client;
    }

    public function find(string $tokenClass, string $userId): Token 
    {
        $key = $this->makeKey($tokenClass, $userId);
        $result = $this->client->get($key);

        return Token::fromString($result);
    }

    public function save(Token $token, string $userId): void 
    {
        $key = $this->makeKey(get_class($token), $userId);
        $this->client->set($key, $token->toString());
    }

    public function delete(string $tokenClass, string $userId): void
    {
        $key = $this->makeKey($tokenClass, $userId);
        $this->client->del($key);
    }

    private function makeKey(string $tokenClass, string $userId): string
    {
        $type = '';
        if ($tokenClass == AccessToken::class) {
            $type = 'access_token';
        } else {
            $type = 'refresh_token';
        }

        return $type . "-" . $userId;
    }
}