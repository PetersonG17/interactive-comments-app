<?php

namespace App\User\Api\V1\Commands;

class CreateUserCommand
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
    ) {
    }
}
