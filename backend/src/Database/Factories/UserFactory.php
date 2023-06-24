<?php

namespace Database\Factories;

use App\User\Domain\User;
use App\User\Infrastructure\Services\Md5HashingService;

class UserFactory extends DatabaseRecordFactory {

    public function make(): User
    {
        return new User(
            $this->faker->uuid(),
            $this->faker->email(),
            $this->faker->firstName(),
            $this->faker->lastName(),
            Md5HashingService::hash($this->faker->word())
        );
    }

    public function create(): User
    {
        $user = $this->make();

        $this->database::table('users')
            ->updateOrInsert(
                [
                    "id" => $user->id(),
                    "email" => $user->email(),
                    "first_name" => $user->firstName(),
                    "last_name" => $user->lastName(),
                    "password" => $user->hashedPassword()->value(),
                ]
            );

        return $user;
    }
}