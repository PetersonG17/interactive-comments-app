<?php

namespace App\Author\Domain;

interface AuthorRepository
{
    public function find(int $id): Author;

    public function save(Author $author): void;
}
