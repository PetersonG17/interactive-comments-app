<?php

namespace Tests\Integration\User;

use App\User\Domain\User;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\User\Infrastructure\UserDatabaseRepository;
use Database\Factories\UserFactory;
use Tests\TestCase;

class UserDatabaseRepositoryTest extends TestCase
{
    private Capsule $database;
    private UserDatabaseRepository $repository;
    private UserFactory $factory;
    private string $cleanupId;

    public function setUp(): void
    {
        $this->database = $this->container->get(Capsule::class);
        $this->repository = new UserDatabaseRepository($this->database);

        $this->factory = $this->container->get(UserFactory::class);
    }

    /**
     * @test
     */
    public function it_finds_a_user_by_id()
    {
        $expectedUser = $this->factory->create();
        $this->cleanupId = $expectedUser->id();

        $user = $this->repository->find($expectedUser->id());

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->id(), $expectedUser->id());
        $this->assertEquals($user->email(), $expectedUser->email());
        $this->assertEquals($user->firstName(), $expectedUser->firstName());
        $this->assertEquals($user->lastName(), $expectedUser->lastName());
        $this->assertEquals($user->hashedPassword()->value(), $expectedUser->hashedPassword()->value());
    }

    /**
     * @test
     */
    public function it_finds_a_user_by_credentials()
    {
        $expectedUser = $this->factory->create();
        $this->cleanupId = $expectedUser->id();

        $user = $this->repository->findByCredentials($expectedUser->email(), $expectedUser->hashedPassword());

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->id(), $expectedUser->id());
        $this->assertEquals($user->email(), $expectedUser->email());
        $this->assertEquals($user->firstName(), $expectedUser->firstName());
        $this->assertEquals($user->lastName(), $expectedUser->lastName());
        $this->assertEquals($user->hashedPassword()->value(), $expectedUser->hashedPassword()->value());
    }

    /**
     * @test
     */
    public function it_can_save_a_user_object()
    {
        $expectedUser = $this->factory->make();
        $this->cleanupId = $expectedUser->id();

        $this->repository->save($expectedUser);

        $record = $this->database::table('users')
            ->select('*')
            ->where('id', $expectedUser->id())
            ->get();

        $this->assertEquals($record[0]->id, $expectedUser->id());
        $this->assertEquals($record[0]->email, $expectedUser->email());
        $this->assertEquals($record[0]->first_name, $expectedUser->firstName());
        $this->assertEquals($record[0]->last_name, $expectedUser->lastName());
        $this->assertEquals($record[0]->password, $expectedUser->hashedPassword()->value());
    }

    public function tearDown(): void
    {
        // Cleanup Database
        $this->database::table('users')->delete($this->cleanupId);

        unset($this->repository);
        unset($this->database);
        unset($this->factory);
    }
}
