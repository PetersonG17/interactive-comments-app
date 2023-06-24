<?php

namespace App\User\Infrastructure;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObjects\HashedPassword;

class UserDatabaseRepository implements UserRepository
{
    public const TABLE_NAME = 'users';

    private Capsule $database;

    public function __construct(Capsule $database)
    {
        $this->database = $database;
    }

    public function findByCredentials(string $email, HashedPassword $hashedPassword): User
    {
        // TODO: Validation
        $result = $this->database::table(self::TABLE_NAME)
            ->select('*')
            ->where('email', $email)
            ->where('password', $hashedPassword->value())
            ->get();

        return new User(
            $result[0]->id,
            $result[0]->email,
            $result[0]->first_name,
            $result[0]->last_name,
            new HashedPassword($result[0]->password)
        );
    }

    public function find(string $id): User
    {
        // TODO: Validation
        $result = $this->database::table(self::TABLE_NAME)
            ->select('*')
            ->where('id', $id)
            ->get();

        return new User(
            $result[0]->id,
            $result[0]->email,
            $result[0]->first_name,
            $result[0]->last_name,
            new HashedPassword($result[0]->password)
        );
    }

    public function save(User $user): void
    {
        $this->database::table(self::TABLE_NAME)
            ->updateOrInsert(
                [
                    "id" => $user->id(),
                    "email" => $user->email(),
                    "first_name" => $user->firstName(),
                    "last_name" => $user->lastName(),
                    "password" => $user->hashedPassword()->value(),
                ]
            );
    }
}
