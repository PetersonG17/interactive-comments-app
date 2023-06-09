<?php

namespace App\User\Domain\ValueObjects;

class HashedPassword 
{
    private string $hashedPassword;

    public function __construct(string $hashedPassword) 
    {
        $this->hashedPassword = $hashedPassword;
    }

    public function value(): string
    {
        return $this->hashedPassword;
    }
}