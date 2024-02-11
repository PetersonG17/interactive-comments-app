<?php

namespace Tests\Unit;

use App\Domain\ValueObjects\HashedPassword;
use App\Infrastructure\Services\Md5HashingService;
use Tests\TestCase;

class Md5HashingServiceTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_a_hashed_password_value_object()
    {
        $testString = 'password';

        $hash = Md5HashingService::hash($testString);

        $this->assertInstanceOf(HashedPassword::class, $hash);
    }
    /**
     * @test
     */
    public function it_returns_the_same_hash_when_the_same_string_is_given()
    {
        $testString = 'password';

        $hash1 = Md5HashingService::hash($testString);
        $hash2 = Md5HashingService::hash($testString);

        $this->assertEquals($hash1->value(), $hash2->value());
    }
}
