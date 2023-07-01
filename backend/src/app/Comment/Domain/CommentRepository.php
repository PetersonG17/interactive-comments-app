<?php

namespace App\Comment\Domain;

interface CommentRepository
{
    public function find(string $id): Comment;

    public function save(Comment $comment): void;

    public function getCommentsByAuthorId(string $authorId): array;
}
