<?php

namespace App\Domain\Interfaces;

use App\Domain\ValueObjects\HashedPassword;
use App\Domain\User;

interface UserRepository
{
    public function findByCredentials(string $email, HashedPassword $password): User;

    public function find(string $id): User;

    public function save(User $user): void;
}
