<?php

namespace App\User\Domain;

use App\User\Domain\ValueObjects\HashedPassword;

interface UserRepository
{
    public function findByCredentials(string $email, HashedPassword $password): User;

    public function find(string $id): User;

    public function save(User $user): void;
}
