<?php

namespace App\Infrastructure\Queries\Users;

use Carbon\Carbon;
use App\Infrastructure\Queries\Query;
use App\Infrastructure\Queries\QueryParameters;
use App\Infrastructure\Queries\Users\UserDTO;

class GetSingleUserQuery extends Query {

    public function execute(QueryParameters $parameters): UserDTO
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
            Carbon::parse($record->created_at)
        );
    }
}