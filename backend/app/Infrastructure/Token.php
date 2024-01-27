<?php

namespace App\Infrastructure;

use Carbon\Carbon;

abstract class Token
{
    // TODO: make this expires its own unix timestamp class...
    private Carbon $expires; // Unix timestamp that the token expires at
    private Carbon $createdAt;
    private string $encodedJwt;
    private TokenType $type;

    public function __construct(
        Carbon $expires,
        Carbon $createdAt,
        string $encodedJwt,
        TokenType $type
    )
    {
        $this->expires = $expires;
        $this->createdAt = $createdAt;
        $this->encodedJwt = $encodedJwt;
        $this->type = $type;
    }

    public function isExpired(): bool
    {
        return $this->expires->lessThan(Carbon::now());
    }

    public function value(): string
    {
        return $this->encodedJwt;
    }

    public function toArray(): array
    {
        return  [
            'expires' => $this->expires->timestamp,
            'created_at' => $this->createdAt->timestamp,
            'encoded_jwt' => $this->encodedJwt,
        ];
    }

    public function expires(): Carbon
    {
        return $this->expires;
    }

    abstract public function type(): TokenType;
}