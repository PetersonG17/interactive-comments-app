<?php

namespace App\Application\Commands;

class CreateUserCommand
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
    ) {
    }
}
