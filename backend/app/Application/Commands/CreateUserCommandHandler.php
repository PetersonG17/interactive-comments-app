<?php

namespace App\Application\Commands;

use App\Domain\User;
use App\Domain\Interfaces\UserRepository;
use App\Domain\Services\HashingService;

class CreateUserCommandHandler
{
    private UserRepository $repo;
    private HashingService $hashingService;

    public function __construct(UserRepository $repo, HashingService $hashingService)
    {
        $this->repo = $repo;
        $this->hashingService = $hashingService;
    }

    public function handle(CreateUserCommand $command): void
    {
        // TODO: Error handling
        $user = new User(
            $command->id,
            $command->email,
            $command->firstName,
            $command->lastName,
            $this->hashingService->hash($command->password),
        );

        $this->repo->save($user);
    }
}