<?php

namespace App\Oauth\Api\V1\Commands;

class CreateTokenCommand
{

    public function __construct(
        public readonly string $grantType,
        public readonly string $email,
        public readonly string $password
    )
    {

    }
}