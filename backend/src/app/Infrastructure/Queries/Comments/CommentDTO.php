<?php

namespace App\Infrastructure\Queries\Comments;

use Carbon\Carbon;

class CommentDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $authorId,
        public readonly string $content,
        public readonly Carbon $createdAt
    ){}
}