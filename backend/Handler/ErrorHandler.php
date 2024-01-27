<?php

namespace Handler;

use Throwable;
use Psr\Http\Message\ResponseInterface;

class ErrorHandler
{
    public static function handle(Throwable $e): ResponseInterface
    {
        dd($e);
    }
}