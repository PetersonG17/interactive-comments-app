<?php

namespace App\Domain\Entities;

use App\Domain\Entities\Entity;
use App\Domain\User;
use App\Domain\Interfaces\UserRepository;

class Comment extends Entity
{
    private string $id;
    private string $authorId;
    public User|null $author;
    private string $content;
    private array $likes = [];

    public function __construct(string $id, string $authorId, string $content, array $likes=[], User $author=null)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->content = $content;
        $this->likes = $likes;
        $this->author = $author;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function authorId(): string
    {
        return $this->authorId;
    }

    public function author(UserRepository $repository): User
    {
        if(!isset($this->author)) {
            $this->author = $repository->find($this->authorId);
        }

        return $this->author;
    }

    public function content(): string
    {
        return $this->content;
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
