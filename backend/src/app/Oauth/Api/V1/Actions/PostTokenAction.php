<?php

namespace App\Oauth\Api\V1\Actions;

use App\Oauth\Api\V1\Commands\CreateTokenCommand;
use App\Oauth\Api\V1\Commands\CreateTokenCommandHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Psr7\Response;

class PostTokenAction
{
    private CreateTokenCommandHandler $handler;

    public function __construct(CreateTokenCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request, ResponseInterface $response, array $args)
    {
        // TODO: Add Validation
        // client_id, & client_secret

        $command = new CreateTokenCommand('test', 'test', 'test');
        $this->handler->handle($command);

        // Construct response body
        // https://www.oauth.com/oauth2-servers/access-tokens/password-grant/
        // https://www.oauth.com/oauth2-servers/access-tokens/access-token-response/
        $body = json_encode(
            [
                "access_token" => "mF_9.B5f-4.1JqM",
                "token_type" => "Bearer",
                "expires_in" => 3600,
                "refresh_token" => "tGzv3JOkF0XG5Qx2TlKWIA"
            ]
        );

        return new Response(201, ['Content-Type' => 'application/json'], $body);
    }
}