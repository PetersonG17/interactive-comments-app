<?php

namespace App\Oauth\Api\V1\Commands;

use App\User\Domain\ValueObjects\HashedPassword;
use App\Oauth\Infrastructure\Factories\TokenFactory;
use App\User\Domain\UserRepository;
use App\Oauth\Infrastructure\Token;
use App\Oauth\Infrastructure\TokenType;
use App\User\Domain\Services\HashingService;
use App\User\Infrastructure\Services\Md5HashingService;

class CreateTokenCommandHandler
{
    private UserRepository $repo;
    private TokenFactory $factory;

    public function __construct(UserRepository $repo, TokenFactory $factory)
    {
        $this->repo = $repo;
        $this->factory = $factory;
    }

    public function handle(CreateTokenCommand $command): Token
    {
        // Check if user is in repo
        $hashedPassword = Md5HashingService::hash($command->password);

        $user = $this->repo->findByCredentials($command->email, $hashedPassword);

        $this->factory::make(TokenType::ACCESS, $user);

        // TODO: save token with repo
        // TODO: create refresh token
    }
}