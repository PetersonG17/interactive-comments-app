<?php

namespace App\Oauth\Infrastructure;

use Carbon\Carbon;

class Token
{
    private TokenType $type;
    // TODO: make this expires its own unix timestamp class...
    private int $expires; // Unix timestamp that the token expires at
    private Carbon $createdAt;
    private string $encodedJwt;

    public function __construct(
        TokenType $type,
        int $expires,
        Carbon $createdAt,
        string $encodedJwt
    )
    {
        $this->type = $type;
        $this->expires = $expires;
        $this->createdAt = $createdAt;
        $this->encodedJwt = $encodedJwt;
    }

    public function isExpired(): bool
    {
        $expirationDate = Carbon::createFromTimestamp($this->expires);

        return $expirationDate->lessThan(Carbon::now());
    }

    public function value(): string
    {
        return $this->encodedJwt;
    }

    public function type(): TokenType
    {
        return $this->type;
    }
}