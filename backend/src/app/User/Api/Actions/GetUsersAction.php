<?php

namespace App\User\Api\Actions;

use App\User\Domain\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetUsersAction
{
    private UserRepository $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        dd($this->repo);
        $test = json_encode(["testing" => "test"]);
        $response->getBody()->write($test);

        return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
    }
}