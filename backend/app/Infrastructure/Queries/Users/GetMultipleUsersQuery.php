<?php

namespace App\Infrastructure\Queries\Users;

use Carbon\Carbon;
use App\Infrastructure\Queries\Query;
use App\Infrastructure\Queries\QueryParameters;
use App\Infrastructure\Queries\Users\UserDTO;

class GetMultipleUsersQuery extends Query {

    public function execute(QueryParameters $parameters): array
    {
        // TODO: Exception handling
        $records = $this->database::table('users')
            ->select('*')
            ->get();

        $users = [];
        foreach ($records as $record) {
            $users[] = new UserDTO(
                $record->id,
                $record->first_name,
                $record->last_name,
                $record->email,
                Carbon::parse($record->created_at)
            );
        }
        
        return $users;
    }
}