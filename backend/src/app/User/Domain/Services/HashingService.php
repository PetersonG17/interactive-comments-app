<?php

namespace App\User\Domain\Services;

interface HashingService
{
    public function hash(string $password): string;
}