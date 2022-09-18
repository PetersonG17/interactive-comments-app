<?php

namespace App\Comment\Domain\Values;

use App\Author\Domain\Author;
use DateTimeInterface;

class Like
{
    private Author $author;
    private DateTimeInterface $timestamp;

    public function __construct(Author $author, DateTimeInterface $timestamp)
    {
        $this->author = $author;
        $this->timestamp = $timestamp;
    }

    public function author(): Author
    {
        return $this->author;
    }

    public function timestamp(): DateTimeInterface
    {
        return $this->timestamp;
    }
}
