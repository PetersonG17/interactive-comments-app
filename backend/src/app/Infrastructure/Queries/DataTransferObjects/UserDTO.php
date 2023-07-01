<?php

namespace App\Infrastructure\Queries\DataTransferObjects;

use App\Infrastructure\Queries\DataTransferObjects\DataTransferObject;
use Carbon\Carbon;

class UserDTO extends DataTransferObject
{
    public function __construct(
        public readonly int $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly Carbon $createdAt
    ){}
}