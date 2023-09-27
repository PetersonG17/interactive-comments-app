<?php

namespace App\Application\V1\Actions;

use App\Infrastructure\Queries\GetSingleUserQuery;
use App\Infrastructure\Queries\QueryParameters;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class GetUserAction
{
    public function __construct(private GetSingleUserQuery $query)
    {}

    public function __invoke(Request $request, ResponseInterface $responseInterface, array $args)
    {
        // TODO: Validation
        // TODO: Tests

        $params = (new QueryParameters())->add('id', $args['id']);
        $userDTO = $this->query->execute($params);

        $body = json_encode(
            [
                "_meta" => [
                    "success" => true
                ],
                "result" => [
                    "id" => $userDTO->id,
                    "email" => $userDTO->email,
                    "first_name" => $userDTO->firstName,
                    "last_name" => $userDTO->lastName,
                ]
            ]
        );
        
        return new Response(200, ['Content-Type' => 'application/json'], $body);
    }
}