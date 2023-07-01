<?php

namespace Tests\Unit;

use App\Domain\Interfaces\UserRepository;
use Database\Factories\CommentFactory;
use Database\Factories\UserFactory;
use Mockery;
use App\Domain\User;
use Tests\TestCase;

class CommentTest extends TestCase
{
    private UserRepository $mockRepository;
    private CommentFactory $commentFactory;
    private User $user;

    protected function setUp(): void
    {
        $this->mockRepository = Mockery::mock(UserRepository::class);
        $this->commentFactory = $this->container->get(CommentFactory::class);
        $userFactory = $this->container->get(UserFactory::class);
        $this->user = $userFactory->make();
    }

    /**
     * @test
     */
    public function it_fetches_the_author_if_it_is_not_loaded()
    {
        $comment = $this->commentFactory->make(
            [
                'author_id' => $this->user->id()
            ]
        ); // Default does not load author only the author Id

        $this->mockRepository->shouldReceive('find')
            ->with($comment->authorId())
            ->andReturn($this->user)
            ->once();

        $author = $comment->author($this->mockRepository);

        $this->assertSame($this->user, $author);
    }

    /**
     * @test
     */
    public function it_does_not_fetch_the_author_if_it_is_loaded()
    {
        $comment = $this->commentFactory->make(
            [
                'author_id' => $this->user->id(),
                'author' => $this->user
            ]
        );

        // Set new expectation
        $this->mockRepository->shouldReceive('find')
            ->never();

        $author = $comment->author($this->mockRepository);

        $this->assertSame($this->user, $author);
    }
}
