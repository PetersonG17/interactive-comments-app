<?php

namespace App\Comment\Domain;

use App\Shared\Domain\Entity;
use DateTimeInterface;
use App\User\Domain\User;

class Comment extends Entity
{
    private string $id;
    private User $author;
    private string $content;
    private DateTimeInterface $createdAt;
    private array $likes = [];

    public function __construct(string $id, User $author, string $content, DateTimeInterface $createdAt, array $likes = [])
    {
        $this->id = $id;
        $this->author = $author;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->likes = $likes;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function author(): User
    {
        return $this->author;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function score(): int
    {
        return count($this->likes);
    }

    public function like(User $author): void
    {

    }

    public function unlike(User $author): void
    {

    }
}
