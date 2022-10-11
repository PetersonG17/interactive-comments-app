<?php

namespace App\Oauth\Api\V1\Commands;

use App\User\Domain\ValueObjects\HashedPassword;
use App\Oauth\Infrastructure\Factories\TokenFactory;
use App\User\Domain\UserRepository;
use App\Oauth\Infrastructure\Token;
use App\Oauth\Infrastructure\TokenType;

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
        $user = $this->repo->findByCredentials($command->email, new HashedPassword($command->password));

        $this->factory::make(TokenType::ACCESS, $user);

        // TODO: save token with repo
        // TODO: create refresh token
    }
}