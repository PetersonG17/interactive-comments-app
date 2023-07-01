<?php

namespace App\Infrastructure\DTO;

use Carbon\Carbon;

class UserDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly Carbon $createdAt
    ){}
}