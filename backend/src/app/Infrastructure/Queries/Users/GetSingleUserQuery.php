<?php

namespace App\Infrastructure\Queries;

use App\Infrastructure\Queries\DataTransferObjects\DataTransferObject;
use App\Infrastructure\Queries\DataTransferObjects\UserDTO;

class GetSingleUserQuery extends Query {

    public function execute(QueryParameters $parameters): DataTransferObject
    {
        // TODO: Exception handling
        $record = $this->database::table('users')
            ->select('*')
            ->find($parameters->get('id'));

        return new UserDTO(
            $record->id,
            $record->first_name,
            $record->last_name,
            $record->email,
            $record->created_at
        );
    }
}