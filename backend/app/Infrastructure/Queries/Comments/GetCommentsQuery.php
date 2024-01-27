<?php

namespace App\Infrastructure\Queries;

use App\Infrastructure\Queries\Comments\CommentDTO;

class GetCommentsQuery extends Query {

    public function execute(QueryParameters $parameters): array
    {
        // TODO: Exception handling
        $query = $this->database::table('comments')
            ->select('*');

        $records = [];
        if ($parameters->has('id')) {
            $records = $query->where('id', $parameters->get('id'))->all();
        } else if ($parameters->has('author_id')) {
            $records = $query->where('author_id', $parameters->get('author_id'))->all();
        }

        // TODO: If no params are defined throw exception

        $comments = [];
        foreach($records as $record) {
            $comments[] = new CommentDTO(
                $record->id,
                $record->author_id,
                $record->content,
                $record->created_at
            );
        }

        return $comments;
    }
}