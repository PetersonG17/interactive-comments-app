<?php

namespace App\User\Api\V1\Actions;

use App\User\Domain\UserRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class GetUserAction
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request, ResponseInterface $responseInterface, array $args)
    {
        // TODO: Validation
        // TODO: Tests
        $userId = $args['id'];

        $user = $this->repository->find($userId);

        $body = json_encode(
            [
                "id" => $user->id(),
                "email" => $user->email(),
                "first_name" => $user->firstName(),
                "last_name" => $user->lastName(),
            ]
        );
        
        return new Response(200, ['Content-Type' => 'application/json'], $body);
    }
}