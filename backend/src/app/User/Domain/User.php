<?php

namespace App\User\Domain;

use App\User\Domain\ValueObjects\HashedPassword;

class User
{
    private int $id;
    private string $email;
    private string $firstName;
    private string $lastName;
    private HashedPassword $hashedPassword;

    public function __construct(int $id, string $email, string $firstName, string $lastName, HashedPassword $hashedPassword)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->hashedPassword = $hashedPassword;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function email(): int
    {
        return $this->email;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function hashedPassword(): HashedPassword
    {
        return $this->hashedPassword;
    }
}