<?php

namespace App\Infrastructure;

use Carbon\Carbon;

abstract class Token
{
    // TODO: make this expires its own unix timestamp class...
    private Carbon $expires; // Unix timestamp that the token expires at
    private Carbon $createdAt;
    private string $encodedJwt;

    public function __construct(
        Carbon $expires,
        Carbon $createdAt,
        string $encodedJwt
    )
    {
        $this->expires = $expires;
        $this->createdAt = $createdAt;
        $this->encodedJwt = $encodedJwt;
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
            'encoded_jwt' => $this->encodedJwt
        ];
    }

    public function __serialize(): array
    {
        return $this->toArray();
    }

    public function __unserialize(array $data): void
    {
        $this->expires->timestamp = $data['expires'];
        $this->createdAt->timestamp = $data['created_at'];
        $this->encodedJwt = $data['encoded_jwt'];
    }

    public function __toString(): string
    {
        return json_encode($this->toArray()) ?: "";
    }

    public function toString(): string
    {
        return $this->__toString();
    }

    public static function fromString(string $string): Token
    {
        // TODO: Test and throw exception if string cannot be deciphered
        $data = json_decode($string, true);

        return new static(
            Carbon::parse($data['expires']),
            Carbon::parse($data['created_at']),
            $data['encoded_jwt']
        );
    }
}