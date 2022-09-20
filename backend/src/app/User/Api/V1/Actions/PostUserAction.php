<?php

namespace App\User\Api\V1\Actions;

use App\User\Api\V1\Commands\CreateUserCommand;
use App\User\Api\V1\Commands\CreateUserCommandHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Psr7\Response;

class PostUserAction
{
    private CreateUserCommandHandler $handler;

    public function __construct(CreateUserCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request, ResponseInterface $response, array $args)
    {
        // TODO: Add Validation
        // TODO: Add helper method for getting json from request. Probably a new request class...
        $body = json_decode($request->getBody()->getContents());

        $command = new CreateUserCommand($body->first_name, $body->last_name);

        $userId = $this->handler->handle($command);

        // Construct response body
        $body = json_encode(
            [
                "message" => "User successfully created",
                "location" => [
                    "method" => "GET",
                    "href" => $this->getBaseUrl($request) . "/api/v1/users/" . $userId
                ]
            ]
        );

        return new Response(201, ['Content-Type' => 'application/json'], $body);
    }

    private function getBaseUrl($request): string
    {
        $uri = $request->getUri();

        $baseUrl = $uri->getScheme() . '://'
            . $request->getUri()->getHost()
            . ($request->getUri()->getPort() ? ':' . $request->getUri()->getPort() : '');

        return $baseUrl;
    }
}