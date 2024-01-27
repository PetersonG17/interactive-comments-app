<?php

namespace App\Application\Commands;

class CreateTokenCommand
{

    public function __construct(
        public readonly string $email,
        public readonly string $password
    )
    {

    }
}