<?php

namespace App\User\Domain;

use App\Shared\Domain\Entity;
use App\User\Domain\ValueObjects\HashedPassword;

class User extends Entity
{
    private string $id;
    private string $email;
    private string $firstName;
    private string $lastName;
    private HashedPassword $hashedPassword;

    public function __construct(string $id, string $email, string $firstName, string $lastName, HashedPassword $hashedPassword)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->hashedPassword = $hashedPassword;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
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