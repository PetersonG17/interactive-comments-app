<?php

namespace App\Oauth\Domain;

use DateTimeInterface;

class Token
{
    private TokenType $type;
    private int $expires; // Time in seconds till token expires
    private DateTimeInterface $createdAt;

    public function __construct(
        TokenType $type,
        int $expires,
        DateTimeInterface $createdAt
    )
    {
        $this->type = $type;
        $this->expires = $expires;
        $this->createdAt = $createdAt;
    }

    public function isExpired(): bool
    {
        // TODO: Implement this...
    }
}