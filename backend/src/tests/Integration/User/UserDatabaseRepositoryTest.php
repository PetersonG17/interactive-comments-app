<?php

namespace Tests\Integration\User;

use App\Shared\Infrastructure\UuidGenerator;
use App\User\Domain\User;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\User\Infrastructure\UserDatabaseRepository;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Tests\TestCase;

class UserDatabaseRepositoryTest extends TestCase
{
    private Capsule $database;
    private UserDatabaseRepository $repository;
    private UserFactory $factory;
    private User $user;

    public function setUp(): void
    {
        $this->database = $this->container->get(Capsule::class);
        $this->repository = new UserDatabaseRepository($this->database);

        $this->factory = $this->container->get(UserFactory::class);
        $this->user = $this->factory->create();
    }

    /**
     * @test
     */
    public function it_finds_a_user_by_id()
    {
        $user = $this->repository->find($this->user->id());

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->id(), $this->user->id());
        $this->assertEquals($user->email(), $this->user->email());
        $this->assertEquals($user->firstName(), $this->user->firstName());
        $this->assertEquals($user->lastName(), $this->user->lastName());
        $this->assertEquals($user->hashedPassword()->value(), $this->user->hashedPassword()->value());
    }

    public function tearDown(): void
    {
        // Cleanup Database
        $this->database::table('users')->delete($this->user->id());

        unset($this->repository);
        unset($this->database);
    }
}
