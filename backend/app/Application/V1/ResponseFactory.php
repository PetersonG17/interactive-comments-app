<?php

namespace App\Application\V1;

use GuzzleHttp\Psr7\Response;

class ResponseFactory extends Response {

    private int $status;
    private array $headers;
    private array $body;

    // TODO: Flesh out this class to unify the response structure for responses
    public function success(array $result): self
    {
        $this->status = $status;
        $this->result = $result;
        return $this;
    }

    public function result(array $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function make(): Response
    {
        $body = [
            "_meta" => [

            ]
        ];

        return new Response(
            $this->status,
            ['Content-Type' => 'application/json'],

        );
    }
}