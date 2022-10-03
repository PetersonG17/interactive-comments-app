<?php

namespace App\User\Domain;

interface UserRepository
{
    public function findByCredentials(string $email, string $password): User;

    public function find(int $id): User;

    public function save(User $user): void;

    public function nextId(): int;
}
