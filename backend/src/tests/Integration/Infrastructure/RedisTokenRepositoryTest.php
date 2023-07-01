<?php

namespace Tests\Integration\Infrastructure;

use App\Infrastructure\Repositories\RedisTokenRepository;
use App\Infrastructure\Token;
use App\Infrastructure\TokenType;
use Carbon\Carbon;
use Tests\TestCase;

class RedisTokenRepositoryTest extends TestCase
{
    private \Predis\Client $client;
    private RedisTokenRepository $repository;
    private int $userId = 123;

    public function setUp(): void
    {
        $this->client = $this->container->get(\Predis\Client::class);
        $this->repository = new RedisTokenRepository($this->client);
    }

    /**
     * @test
     */
    public function it_returns_a_token_for_a_user_id()
    {
        $token = new Token(
            TokenType::ACCESS,
            Carbon::now()->addDay(),
            Carbon::now()->subDay(),
            "SomeEncodedString"
        );

        $this->client->set('token-' . $this->userId, $token);

        $token = $this->repository->find($this->userId);

        $this->assertInstanceOf(Token::class, $token);
    }

    public function tearDown(): void
    {
        unset($this->repository);
    }
}
