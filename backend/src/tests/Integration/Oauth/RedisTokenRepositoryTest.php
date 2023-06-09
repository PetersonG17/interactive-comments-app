<?php

namespace Tests\Integration\Oauth;

use App\Oauth\Infrastructure\Repositories\RedisTokenRepository;
use App\Oauth\Infrastructure\Token;
use App\Oauth\Infrastructure\TokenType;
use Carbon\Carbon;
use \Predis\Client;
use \Mockery;
use Tests\TestCase;

class RedisTokenRepositoryTest extends TestCase
{
    private RedisTokenRepository $repository;
    private $userId = 123;

    public function setUp(): void
    {
        $client = $this->container->get(\Predis\Client::class);
        $this->repository = new RedisTokenRepository($client);
    }

    /**
     * @test
     */
    public function it_returns_a_token_for_a_user_id()
    {
        $token = $this->repository->find($this->userId);

        $this->assertInstanceOf(Token::class, $token);
    }

    public function tearDown(): void
    {
        unset($this->repository);
    }
}
