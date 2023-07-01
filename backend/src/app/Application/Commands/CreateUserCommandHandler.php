<?php

namespace App\Application\Commands;

use App\Domain\User;
use App\Domain\UserRepository;

class CreateUserCommandHandler
{
    private UserRepository $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
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