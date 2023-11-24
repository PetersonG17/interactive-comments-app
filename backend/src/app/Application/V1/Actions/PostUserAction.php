<?php

namespace App\Application\V1\Actions;

use App\Application\Commands\CreateUserCommand;
use App\Application\Commands\CreateUserCommandHandler;
use App\Infrastructure\Generators\UuidGenerator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Psr7\Response;

class PostUserAction
{
    private CreateUserCommandHandler $handler;
    private UuidGenerator $uuidGenerator;

    public function __construct(CreateUserCommandHandler $handler, UuidGenerator $uuidGenerator)
    {
        $this->handler = $handler;
        $this->uuidGenerator = $uuidGenerator;
    }

    public function __invoke(Request $request, ResponseInterface $response, array $args)
    {
        // TODO: Add Validation
        // TODO: Add helper method for getting json from request. Probably a new request class...
        $body = json_decode($request->getBody());

        // Validate the request body
        // TODO: Clean this up, additional validation on email
        if (!isset($body->email) || !isset($body->first_name) || !isset($body->last_name) || !isset($body->password)) {
            return new Response(400, ['Content-Type' => 'application/json'], json_encode(['message' => 'Invalid request body. Required Fields: email, first_name, last_name, password.']));
        }

        $id = $this->uuidGenerator->make();
        $command = new CreateUserCommand($id, $body->email, $body->first_name, $body->last_name, $body->password);

        $this->handler->handle($command);

        // Construct response body
        $body = json_encode(
            [
                "id" => $id,
                "message" => "User successfully created",
            ]
        );

        $headers = [
            'Content-Type' => 'application/json',
            'Location' => $this->getBaseUrl($request) . '/api/v1/users/' . $id
        ];
        return new Response(201, $headers, $body);
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