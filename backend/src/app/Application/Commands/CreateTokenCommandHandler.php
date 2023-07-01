<?php

namespace App\Application\Commands;

use App\Infrastructure\Factories\TokenFactory;
use App\Domain\UserRepository;
use App\Oauth\Infrastructure\TokenType;
use App\Domain\Services\HashingService;
use App\Infrastructure\Services\Md5HashingService;

class CreateTokenCommandHandler
{
    private UserRepository $repo;
    private TokenFactory $factory;
    private HashingService $hashingService;

    public function __construct(UserRepository $repo, TokenFactory $factory, HashingService $hashingService)
    {
        $this->repo = $repo;
        $this->factory = $factory;
        $this->hashingService = $hashingService;
    }

    public function handle(CreateTokenCommand $command): void
    {
        $hashedPassword = Md5HashingService::hash($command->password);

        $user = $this->repo->findByCredentials($command->email, $hashedPassword);

        $this->factory::make(TokenType::ACCESS, $user);

        // TODO: save token with repo
        // TODO: create refresh token
    }
}