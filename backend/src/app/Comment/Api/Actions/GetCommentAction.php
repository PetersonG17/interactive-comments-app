<?php

namespace App\Comment\Api\Actions;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCommentAction
{
    // private $container;

    // public function __construct(ContainerInterface $container)
    // {
    //     $this->container = $container;
    // }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        dd("Here! Comment");
    }
}