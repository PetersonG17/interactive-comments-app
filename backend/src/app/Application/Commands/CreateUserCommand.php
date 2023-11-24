<?php

namespace App\Application\Commands;

class CreateUserCommand
{
    public function __construct(
        public readonly string $id,
        public readonly string $email,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $password,
    ) {
    }
}
