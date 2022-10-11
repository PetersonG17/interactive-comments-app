<?php

namespace App\User\Infrastructure;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObjects\HashedPassword;

class UserDatabaseRepository implements UserRepository
{
    public const TABLE_NAME = 'user';

    private Capsule $database;

    public function __construct(Capsule $database)
    {
        $this->database = $database;
    }

    public function findByCredentials(string $email, HashedPassword $password): User
    {
        // TODO: Validation
        $result = $this->database::table('user')
            ->select('*')
            ->where('email', $email)
            ->where('password', $password)
            ->get();

        return new User(
            $result[0]->user_id,
            $result[0]->email,
            $result[0]->first_name,
            $result[0]->last_name,
            $result[0]->password
        );
    }



    public function find(int $id): User
    {
        // TODO: Validation
        $result = $this->database::table('user')
            ->select('*')
            ->where('user_id', $id)
            ->get();

        return new User(
            $result[0]->user_id,
            $result[0]->email,
            $result[0]->first_name,
            $result[0]->last_name,
            $result[0]->password
        );
    }

    public function save(User $user): void
    {
        $this->database::table(self::TABLE_NAME)
            ->updateOrInsert(
                [
                    "user_id" => $user->id(),
                    "email" => $user->email(),
                    "first_name" => $user->firstName(),
                    "last_name" => $user->lastName(),
                    "password" => $user->hashedPassword(),
                ]
            );
    }

    public function nextId(): int
    {
        $result = $this->database::select("SELECT nextval('user_user_id_seq')");

        return $result[0]->nextval;
    }
}
