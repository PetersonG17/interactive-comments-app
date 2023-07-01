<?php

namespace App\Comment\Infrastructure;

use App\Comment\Domain\Comment;
use App\Comment\Domain\CommentRepository;
use Illuminate\Database\Capsule\Manager as Capsule;
use stdClass;

class CommentDatabaseRepository implements CommentRepository
{
    public const TABLE_NAME = 'comments';

    private Capsule $database;

    public function __construct(Capsule $database)
    {
        $this->database = $database;
    }

    public function find(string $id): Comment
    {
        // TODO: Validation
        $record = $this->database::table(self::TABLE_NAME)
            ->select('*')
            ->find($id);
    
        return $this->hydrate($record);
    }

    private function hydrate(stdClass $record): Comment
    {
        return new Comment(
            $record->id,
            $record->author_id,
            $record->content,
            []
        );
    }

    public function save(Comment $comment): void
    {
        $this->database::table(self::TABLE_NAME)
            ->updateOrInsert(
                [
                    "id" => $comment->id(),
                    "author_id" => $comment->authorId(),
                    "content" => $comment->content()
                ]
        );
    }

    public function getCommentsByAuthorId(string $authorId): array
    {
        // TODO: Validation
        $records = $this->database::table(self::TABLE_NAME)
            ->select('*')
            ->where('author_id', $authorId)
            ->get();

        $comments = [];
        foreach($records as $record) {
            $comments[] = $this->hydrate($record);
        }
    
        return $comments;
    }
}