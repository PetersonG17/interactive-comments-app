<?php

namespace App\Application\V1\Actions;

use App\Application\Commands\CreateTokenCommand;
use App\Application\Commands\CreateTokenCommandHandler;
use App\Application\V1\Enums\GrantType;
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

        $body = $request->getBody();

        // Simple validation
        if (!isset($body->email) || !isset($body->password) || !isset($body->grant_type)) {
            return new Response(400, ['Content-Type' => 'application/json'], json_encode(['message' => 'Invalid request body. Required Fields: email, password, grant_type.']));
        }

        try {
            GrantType::tryFrom(strtolower($body->grant_type));
        } catch (\Exception $e) {
            return new Response(400, ['Content-Type' => 'application/json'], json_encode(['message' => 'Invalid grant_type. Valid values: password, refresh_token.']));
        }

        // If password grant type create new access token
        if ($body->grant_type === GrantType::Password->value) {
            $command = new CreateTokenCommand($body->email, $body->password);
            $this->handler->handle($command);
        } else { // Refresh grant type, refresh the access token

        }



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