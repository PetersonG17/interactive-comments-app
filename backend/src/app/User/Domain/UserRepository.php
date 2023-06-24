<?php

namespace App\User\Domain;

use App\Shared\Infrastructure\HydratesEntity;
use App\User\Domain\ValueObjects\HashedPassword;

interface UserRepository extends HydratesEntity
{
    public function findByCredentials(string $email, HashedPassword $password): User;

    public function find(string $id): User;

    public function save(User $user): void;
}
