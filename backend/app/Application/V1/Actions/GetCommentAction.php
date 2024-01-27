<?php

namespace App\Application\V1\Actions;

use App\Infrastructure\Queries\GetCommentsQuery;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCommentsAction {

    private GetCommentsQuery $query;

    public function __construct(GetCommentsQuery $query)
    {
        $this->query = $query;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        Request $request, ResponseInterface $responseInterface, array $args
    }
}