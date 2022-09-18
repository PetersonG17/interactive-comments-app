<?php

namespace App\Comment\Domain;

use DateTimeInterface;
use App\User\Domain\User;

class Comment
{
    private int $id;
    private User $author;
    private string $text;
    private DateTimeInterface $createdAt;
    private array $likes = [];

    public function __construct(int $id, User $author, string $text, DateTimeInterface $createdAt, array $likes = [])
    {
        $this->id = $id;
        $this->author = $author;
        $this->text = $text;
        $this->createdAt = $createdAt;
        $this->likes = $likes;
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
