<?php

namespace App\Oauth\Api\V1\Commands;

class CreateTokenCommandHandler
{
    private \Predis\Client $client;

    public function __construct(\Predis\Client $client)
    {
        $this->client = $client;
    }

    public function handle(CreateTokenCommand $command): int
    {
        $this->client->set('testing', 'test123');
        dd($this->client->get('testing'));
        return 0;
    }
}