<?php

namespace Tests\Unit;

use App\Domain\Entities\Comment;
use App\Domain\Interfaces\CommentRepository;
use App\Infrastructure\Generators\UuidGenerator;
use Database\Factories\CommentFactory;
use Database\Factories\UserFactory;
use Mockery;
use Tests\TestCase;

class UserTest extends TestCase
{
    private CommentRepository $mockRepository;
    private CommentFactory $commentFactory;
    private UserFactory $userFactory;

    protected function setUp(): void
    {
        $this->mockRepository = Mockery::mock(CommentRepository::class);
        $this->userFactory = $this->container->get(UserFactory::class);
        $this->commentFactory = $this->container->get(CommentFactory::class);
    }

    /**
     * @test
     */
    public function it_fetches_comments_if_comments_are_not_loaded()
    {
        $user = $this->userFactory->make(); // Default does not load comments

        // Setup comments for the user
        $expectedComments = [];
        for($i = 0; $i < 10; $i++) {
            $expectedComments[] = $this->commentFactory->make(
                [
                    'author_id' => $user->id()
                ]
            );
        }

        $this->mockRepository->shouldReceive('findByAuthorId')
            ->with($user->id())
            ->andReturn($expectedComments)
            ->once();

        $comments = $user->comments($this->mockRepository);

        $this->assertEquals(count($expectedComments), count($comments));
        $this->assertInstanceOf(Comment::class, $comments[0]);
    }

    /**
     * @test
     */
    public function it_does_not_load_comments_if_already_loaded()
    {
        $uuid = UuidGenerator::make();

        // Setup comments for the user
        $expectedComments = [];
        for($i = 0; $i < 10; $i++) {
            $expectedComments[] = $this->commentFactory->make(
                [
                    'author_id' => $uuid
                ]
            );
        }

        $user = $this->userFactory->make(
            [
                'id' => $uuid,
                'comments' => $expectedComments
            ]
        );

        $this->mockRepository->shouldReceive('findByAuthorId')
            ->never();

        $comments = $user->comments($this->mockRepository);
        
        $this->assertEquals(count($expectedComments), count($comments));
        $this->assertInstanceOf(Comment::class, $comments[0]);
    }
}
