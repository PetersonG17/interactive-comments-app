<?php

namespace App\Comment\Domain;

use DateTimeInterface;
use App\Author\Domain\Author;

class Comment
{
    private int $id;
    private Author $author;
    private string $text;
    private DateTimeInterface $createdAt;
    private array $likes = [];

    public function __construct(int $id, Author $author, string $text, DateTimeInterface $createdAt, array $likes = [])
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

    public function like(Author $author): void
    {

    }

    public function unlike(Author $author): void
    {

    }
}
