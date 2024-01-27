<?php

namespace App\Application\V1\Actions;

use App\Domain\Interfaces\UserRepository;
use App\Infrastructure\Queries\Users\GetMultipleUsersQuery;
use App\Infrastructure\Queries\QueryParameters;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Psr7\Response;

class GetUsersAction
{

    public function __construct(private GetMultipleUsersQuery $query)
    {
    }

    public function __invoke(Request $request, ResponseInterface $response, array $args)
    {
        // TODO: Add Pagination
        // TODO: Exception Handling

        $users = $this->query->execute(new QueryParameters());
        
        $body = [];
        foreach ($users as $user) {
            $body[] = [
                "id" => $user->id,
                "email" => $user->email,
                "first_name" => $user->firstName,
                "last_name" => $user->lastName,
            ];
        }

        $body = json_encode($body);
        
        return new Response(200, ['Content-Type' => 'application/json'], $body);
    }
}