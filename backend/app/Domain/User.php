<?php

namespace App\Domain;

use App\Domain\Interfaces\CommentRepository;
use App\Domain\ValueObjects\HashedPassword;

class User extends Aggregate
{
    private string $id;
    private string $email;
    private string $firstName;
    private string $lastName;
    private HashedPassword $hashedPassword;
    private array|null $comments;

    public function __construct(string $id, string $email, string $firstName, string $lastName, HashedPassword $hashedPassword, array|null $comments=null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->hashedPassword = $hashedPassword;
        $this->comments = $comments;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function hashedPassword(): HashedPassword
    {
        return $this->hashedPassword;
    }

    public function comments(CommentRepository $repository): array
    {
        if (!isset($this->comments)) {
            $this->comments = $repository->findByAuthorId($this->id);
        }

        return $this->comments;
    }
}