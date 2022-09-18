<?php

namespace App\User\Domain;

class User
{
    private int $id;
    private string $firstName;
    private string $lastName;

    public function __construct(int $id, string $firstName, string $lastName)
    {

        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}