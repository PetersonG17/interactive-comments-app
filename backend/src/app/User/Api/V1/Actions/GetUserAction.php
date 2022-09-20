<?php

namespace App\User\Api\V1\Actions;

use App\User\Domain\UserRepository;
use App\User\Infrastructure\Queries\GetSingleUserQuery;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Psr7\Response;

class GetUserAction
{
    private GetSingleUserQuery $query;

    public function __construct(GetSingleUserQuery $query)
    {
        $this->query = $query;
    }

    public function __invoke(Request $request, ResponseInterface $response, array $args)
    {
        // TODO: Validation
        $userId = $args['id'];

        $userDto = $this->query->execute($userId);

        $body = json_encode(
            [
                "user_id" => $userDto->id,
                "first_name" => $userDto->firstName,
                "last_name" => $userDto->lastName,
                "created_at" => $userDto->createdAt->toDateTimeString()
            ]
        );
        
        return new Response(200, ['Content-Type' => 'application/json'], $body);
    }
}