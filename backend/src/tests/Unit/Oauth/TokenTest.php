<?php

namespace Tests\Unit\Oauth;

use App\Oauth\Infrastructure\Token;
use App\Oauth\Infrastructure\TokenType;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_created()
    {
        $expires = Carbon::now()->addDays(5)->timestamp;
        $token = new Token(TokenType::ACCESS, $expires, Carbon::now(), "SomeEncodedJwt");

        $this->assertInstanceOf(Token::class, $token);
    }

    /**
     * @test
     */
    public function it_is_expired_if_expiration_date_is_less_than_today()
    {
        $expires = Carbon::now()->subDays(5)->timestamp;
        $token = new Token(TokenType::ACCESS, $expires, Carbon::now(), "SomeEncodedJwt");

        $this->assertTrue($token->isExpired());
    }

    /**
     * @test
     */
    public function it_is_not_expired_if_expiration_date_is_greater_than_today()
    {
        $expires = Carbon::now()->addDays(5)->timestamp;
        $token = new Token(TokenType::ACCESS, $expires, Carbon::now(), "SomeEncodedJwt");

        $this->assertFalse($token->isExpired());
    }

    /**
     * @test
     */
    public function it_gets_the_type()
    {
        $expires = Carbon::now()->addDays(5)->timestamp;
        $token = new Token(TokenType::ACCESS, $expires, Carbon::now(), "SomeEncodedJwt");

        $this->assertEquals(TokenType::ACCESS, $token->type());
    }

    /**
     * @test
     */
    public function it_gets_the_value()
    {
        $expires = Carbon::now()->addDays(5)->timestamp;
        $token = new Token(TokenType::ACCESS, $expires, Carbon::now(), "SomeEncodedJwt");

        $this->assertEquals("SomeEncodedJwt", $token->value());
    }
}
