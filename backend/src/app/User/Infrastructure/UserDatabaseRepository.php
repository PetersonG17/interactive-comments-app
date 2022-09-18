<?php

namespace App\User\Infrastructure;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\User\Domain\User;
use App\User\Domain\UserRepository;

class UserDatabaseRepository implements UserRepository
{
    private Capsule $database;

    public function __construct(Capsule $database)
    {
        $this->database = $database;
    }

    public function find(int $id): User
    {
        return new User(1, "test", "test");
    }

    public function save(User $user): void
    {
        return;
    }
}
