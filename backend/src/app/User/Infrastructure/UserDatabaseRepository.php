<?php

namespace App\User\Infrastructure;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObjects\HashedPassword;
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
            ->get();

        return $this->hydrate($record);
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

    private function hydrate(array|Collection $record): User
    {
        return new User(
            $record[0]->id,
            $record[0]->email,
            $record[0]->first_name,
            $record[0]->last_name,
            new HashedPassword($record[0]->password)
        );
    }
}
