<?php

namespace App\Infrastructure\Repositories;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Domain\User;
use App\Domain\Interfaces\UserRepository;
use App\Domain\ValueObjects\HashedPassword;
use App\Infrastructure\Exceptions\NotFoundException;
use Illuminate\Support\Collection;

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
        $record = $this->database::table(self::TABLE_NAME)
            ->select('*')
            ->where('email', $email)
            ->where('password', $hashedPassword->value())
            ->first();

        if(!isset($record)) {
            throw new NotFoundException("User not found for given credentials.");
        }

        return $this->hydrate((array) $record);
    }

    public function find(string $id): User
    {
        // TODO: Validation
        $record = $this->database::table(self::TABLE_NAME)
            ->select('*')
            ->where('id', $id)
            ->get();

        return $this->hydrate($record);
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

    private function hydrate(array $record): User
    {
        return new User(
            $record["id"],
            $record["email"],
            $record["first_name"],
            $record["last_name"],
            new HashedPassword($record["password"])
        );
    }
}
