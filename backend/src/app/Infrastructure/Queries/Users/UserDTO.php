<?php

namespace App\Infrastructure\Queries\DataTransferObjects;

use Carbon\Carbon;

class UserDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly Carbon $createdAt
    ){}
}