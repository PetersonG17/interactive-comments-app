<?php

namespace App\User\Api\Commands;

class CreateUserCommand
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
    ) {
    }
}
