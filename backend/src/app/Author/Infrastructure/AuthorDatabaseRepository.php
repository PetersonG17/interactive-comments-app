<?php

namespace App\Author\Infrastructure;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Author\Domain\Author;
use App\Author\Domain\AuthorRepository;

class AuthorDatabaseRepository implements AuthorRepository
{
    private Capsule $database;

    public function __construct(Capsule $database)
    {
        $this->database = $database;
    }

    public function find(int $id): Author
    {
        return new Author(1, "test", "test");
    }

    public function save(Author $author): void
    {
        return;
    }
}
