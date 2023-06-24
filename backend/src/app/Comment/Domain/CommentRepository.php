<?php

namespace App\Comment\Domain;

use App\Shared\Infrastructure\HydratesEntity;

interface CommentRepository extends HydratesEntity
{
    public function find(string $id): Comment;

    public function save(Comment $comment): void;
}
