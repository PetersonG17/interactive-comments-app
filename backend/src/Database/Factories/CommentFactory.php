<?php

namespace Database\Factories;

use App\Comment\Domain\Comment;
use Illuminate\Support\Carbon;

class CommentFactory extends DatabaseRecordFactory {

    public function make(array $overrides = []): Comment
    {
        $records = $this->database::table('users')
            ->select('id')
            ->limit(50)
            ->get();

        $key = array_rand($records->toArray());

        $userId = $records->toArray()[$key]->id;

        return new Comment(
            isset($overrides['id']) ? $overrides['id'] : $this->faker->uuid(),
            isset($overrides['author_id']) ? $overrides['author_id'] : $userId,
            isset($overrides['content']) ? $overrides['content'] : $this->faker->paragraph(4),
        );
    }

    public function create(array $overrides = []): Comment
    {
        $comment = $this->make($overrides);

        $this->database::table('comments')
            ->updateOrInsert(
                [
                    "id" => $comment->id(),
                    "author_id" => $comment->authorId(),
                    "content" => $comment->content(),
                ]
            );

        return $comment;
    }
}