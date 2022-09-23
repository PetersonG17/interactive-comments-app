<?php

namespace App\Oauth\Api\V1\Commands;

class CreateTokenCommandHandler
{
    public function __construct()
    {

    }

    public function handle(CreateUserCommand $command): int
    {
        // TODO: Error handling

        $id = $this->repo->nextId();

        $user = new User(
            $id,
            $command->firstName,
            $command->lastName
        );

        $this->repo->save($user);

        return $user->id();
    }
}