<?php

namespace App\User\Api\Actions;

use App\User\Api\Commands\CreateUserCommand;
use App\User\Api\Commands\CreateUserCommandHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostUserAction
{
    private CreateUserCommandHandler $handler;

    public function __construct(CreateUserCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        // TODO: Add Validation
        // TODO: Add helper method for getting json from request. Probably a new request class...
        $body = json_decode($request->getBody()->getContents());

        $command = new CreateUserCommand($body->first_name, $body->last_name);

        $userId = $this->handler->handle($command);

        // TODO: Format response...
        dd($userId);

        return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
    }
}