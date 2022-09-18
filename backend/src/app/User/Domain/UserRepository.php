<?php

namespace App\User\Domain;

interface UserRepository
{
    public function find(int $id): User;

    public function save(User $author): void;
}
