<?php

namespace App\Comment\Domain;

interface CommentRepository
{
    public function find(int $id): Comment;

    public function save(Comment $comment): void;
}
