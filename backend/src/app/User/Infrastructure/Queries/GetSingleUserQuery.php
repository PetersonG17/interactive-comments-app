<?php

namespace App\User\Infrastructure\Queries;

use App\Shared\Infrastructure\Exceptions\NotFoundException;
use Carbon\Carbon;
use App\User\Infrastructure\DTO\UserDTO;
use Illuminate\Database\Capsule\Manager as Capsule;

class GetSingleUserQuery
{
    private Capsule $database;

    public function __construct(Capsule $database) {
        $this->database = $database;
    }

    public function execute(int $id): UserDTO
    {
        // TODO: Validation
        $result = $this->database::table('user')
            ->select('*')
            ->where('user_id', $id)
            ->get();

        if($result->isEmpty()) {
            throw new NotFoundException("User with ID: $id was not found");
        }

        return new UserDTO(
            $result[0]->user_id,
            $result[0]->first_name,
            $result[0]->last_name,
            Carbon::parse($result[0]->created_at),
        );
    }
}