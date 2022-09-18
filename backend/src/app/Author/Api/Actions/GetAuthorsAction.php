<?php

namespace App\Author\Api\Actions;

use App\Author\Domain\AuthorRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetAuthorsAction
{
    private AuthorRepository $repo;

    public function __construct(AuthorRepository $repo)
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