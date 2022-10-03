<?php

namespace App\Oauth\Api\V1\Commands;

use App\User\Domain\UserRepository;

class CreateTokenCommandHandler
{
    private UserRepository $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function handle(CreateTokenCommand $command): Token
    {
        
        return $token;
    }
}