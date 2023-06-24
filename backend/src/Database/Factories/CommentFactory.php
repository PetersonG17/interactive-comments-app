<?php

namespace Database\Factories;

use App\Comment\Domain\Comment;
use Database\Factories\UserFactory;

class CommentFactory extends DatabaseRecordFactory {

    private array $authorIds = [];

    public function make(): Comment
    {
        for (int $i = 0; $i < 10; $i++) {
            
        }

        dd($userIDs);

        return new Comment(
            $this->faker->uuid(),
            $this->user,
        );
    }

    public function create(): Comment
    {
        $comment = $this->make();

        // $this->database::table('comments')
        //     ->updateOrInsert(
        //         [
        //             "id" => $comment->id(),
        //             "author_id" => ,
        //             "first_name" => $comment->firstName(),
        //             "last_name" => $comment->lastName(),
        //         ]
        //     );

        return $comment;
    }
}