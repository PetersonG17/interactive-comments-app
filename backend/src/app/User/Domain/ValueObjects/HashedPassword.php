<?php

namespace App\User\Domain\ValueObjects;

class HashedPassword 
{
    // TODO: Separate how this is hashed from the domain...
    private const SALT = 'S3cur3V@lu3!';

    private string $hashedPassword;

    public function __construct(string $password) 
    {
        $this->hashedPassword = $this->hash($password);
    }

    private function hash(string $password): string
    {
        return password_hash(self::SALT . $this->password, PASSWORD_DEFAULT);
    }

    public function value(): string
    {
        return $this->hashedPassword;
    }
}