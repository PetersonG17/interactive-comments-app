<?php

namespace App\Comment\Api\Actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCommentAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        dd("Here! Comment");
    }
}