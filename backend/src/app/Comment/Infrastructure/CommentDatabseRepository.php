<?php

namespace App\Comment\Infrastructure;

use App\Comment\Domain\Comment;
use App\Comment\Domain\CommentRepository;
use App\User\Domain\UserRepository;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Collection;

class CommentDatabaseRepository implements CommentRepository
{
    public const TABLE_NAME = 'comments';

    private Capsule $database;
    private UserRepository $repository;

    public function __construct(Capsule $database, UserRepository $repository)
    {
        $this->database = $database;
        $this->repository = $repository;
    }

    public function find(string $id): Comment
    {
        // TODO: Validation
        $record = $this->database::table(self::TABLE_NAME)
            ->select('*')
            ->where('id', $id)
            ->get();
    
        return $this->hydrate($record);
    }

    public function hydrate(array|Collection $record): Comment
    {
        return new Comment(
            $record[0]->id,
            $this->repository->find($record[0]->author_id),
            $record[0]->content,
            Carbon::parse($record[0]->created_at),
            []
        );
    }

    public function save(Comment $comment): void
    {
        
    }
}