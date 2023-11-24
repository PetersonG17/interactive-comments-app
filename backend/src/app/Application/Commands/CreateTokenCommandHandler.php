<?php

namespace App\Application\Commands;

use App\Infrastructure\Factories\TokenFactory;
use App\Domain\Interfaces\UserRepository;
use App\Domain\Services\HashingService;
use App\Infrastructure\Services\Md5HashingService;
use App\Infrastructure\AccessToken;
use App\Infrastructure\Repositories\TokenRepository;

class CreateTokenCommandHandler
{
    private UserRepository $repo;
    private TokenFactory $factory;
    private HashingService $hashingService;
    private TokenRepository $tokenRepository;

    public function __construct(UserRepository $repo, TokenFactory $factory, HashingService $hashingService, TokenRepository $tokenRepository)
    {
        $this->repo = $repo;
        $this->factory = $factory;
        $this->hashingService = $hashingService;
        $this->tokenRepository = $tokenRepository;
    }

    public function handle(CreateTokenCommand $command): void
    {
        $hashedPassword = $this->hashingService::hash($command->password);

        $user = $this->repo->findByCredentials($command->email, $hashedPassword);

        $accessToken = $this->factory::make(AccessToken::class, $user);
        $refreshToken = $this->factory::make(RefreshToken::class, $user);

        $this->tokenRepository->save($accessToken, $user->id());
        $this->tokenRepository->save($refreshToken, $user->id());
    }
}