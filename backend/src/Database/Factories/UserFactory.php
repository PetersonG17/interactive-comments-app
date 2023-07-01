<?php

namespace Database\Factories;

use App\User\Domain\User;
use App\User\Infrastructure\Services\Md5HashingService;

class UserFactory extends DatabaseRecordFactory {

    public function make(array $overrides = []): User
    {
        return new User(
            isset($overrides['id']) ? $overrides['id'] : $this->faker->uuid(),
            isset($overrides['email']) ? $overrides['email'] : $this->faker->email(),
            isset($overrides['first_name']) ? $overrides['first_name'] : $this->faker->firstName(),
            isset($overrides['last_name']) ? $overrides['last_name'] : $this->faker->lastName(),
            isset($overrides['password']) ? $overrides['password'] : Md5HashingService::hash($this->faker->word())
        );
    }

    public function create(array $overrides = []): User
    {
        $user = $this->make($overrides);

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