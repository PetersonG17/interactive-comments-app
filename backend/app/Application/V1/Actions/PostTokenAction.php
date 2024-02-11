<?php

namespace App\Application\V1\Actions;

use App\Application\V1\Enums\GrantType;
use App\Domain\Interfaces\UserRepository;
use App\Domain\ValueObjects\HashedPassword;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Psr7\Response;
use JohnPetersonG17\OAuthTokenManagement\AuthorizationGate;
use JohnPetersonG17\OAuthTokenManagement\Exceptions\TokenExpiredException;
use JohnPetersonG17\OAuthTokenManagement\Exceptions\NotFoundException;
use App\Infrastructure\Exceptions\NotFoundException as InfrastructureNotFoundException;
use App\Infrastructure\Services\Md5HashingService;

class PostTokenAction
{
    private AuthorizationGate $gate;
    private UserRepository $userRepository;

    public function __construct(AuthorizationGate $gate, UserRepository $userRepository)
    {
        $this->gate = $gate;
        $this->userRepository = $userRepository;
    }

    public function __invoke(Request $request, ResponseInterface $response, array $args)
    {
        $body = json_decode($request->getBody());

        // Simple validation
        if (!isset($body->email) && !isset($body->password) && !isset($body->grant_type)) {
            return new Response(400, ['Content-Type' => 'application/json'], json_encode(['message' => 'Invalid request body. Required Fields: email, password, grant_type.']));
        }

        try {
            GrantType::tryFrom(strtolower($body->grant_type));
        } catch (\Exception $e) {
            return new Response(400, ['Content-Type' => 'application/json'], json_encode(['message' => 'Invalid grant_type. Valid values: password, refresh_token.']));
        }

        // TODO: Move this into a separate command class
        // If password grant type create new access token
        if ($body->grant_type === GrantType::Password->value) {

            // Authenticate the user
            try {
                $hashedPassword = Md5HashingService::hash($body->password);
                $user = $this->userRepository->findByCredentials($body->email, $hashedPassword);
            } catch (InfrastructureNotFoundException $e) {
                return new Response(401, ['Content-Type' => 'application/json'], json_encode(['message' => 'The provided credentials are invalid.']));
            } catch (\Exception $e) {
                dd($e);
                return new Response(500, ['Content-Type' => 'application/json'], json_encode(['message' => 'An unknown error occurred. Please contact your system adminstrator.']));
            }

            // Grant the user a token
            try {
                $grant = $this->gate->grant($user->id());
            } catch (\Exception $e) {
                dd($e);
                return new Response(500, ['Content-Type' => 'application/json'], json_encode(['message' => 'An unknown error occurred. Please contact your system adminstrator.']));
            }

        } else { // Refresh grant type, refresh the access token

            try {
                $grant = $this->gate->refresh($body->refresh_token);
            } catch (TokenExpiredException $e) {
                return new Response(401, ['Content-Type' => 'application/json'], json_encode(['message' => 'The refresh token provided is expired. Please login again.']));
            } catch (NotFoundException $e) {
                return new Response(401, ['Content-Type' => 'application/json'], json_encode(['message' => 'The refresh token provided could not be found. Please login again.']));
            } catch (\Exception $e) {
                return new Response(500, ['Content-Type' => 'application/json'], json_encode(['message' => 'An unknown error occurred. Please contact your system adminstrator.']));
            }

        }


        // Construct response body
        // https://www.oauth.com/oauth2-servers/access-tokens/password-grant/
        // https://www.oauth.com/oauth2-servers/access-tokens/access-token-response/
        $body = json_encode(
            [
                "access_token" => $grant->accessToken(),
                "token_type" => $grant->tokenType(),
                "expires_in" => $grant->expiresIn(),
                "refresh_token" => $grant->refreshToken(),
            ]
        );

        return new Response(201, ['Content-Type' => 'application/json'], $body);
    }
}