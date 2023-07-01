<?php

namespace Tests\Integration\Comment;

use App\Comment\Domain\Comment;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Comment\Infrastructure\CommentDatabaseRepository;
use Database\Factories\CommentFactory;
use Database\Factories\UserFactory;
use App\User\Domain\User;
use Tests\TestCase;

class CommentDatabaseRepositoryTest extends TestCase
{
    private Capsule $database;
    private CommentDatabaseRepository $repository;
    private CommentFactory $factory;
    private User $user;
    private array $cleanupIds;

    public function setUp(): void
    {
        $this->database = $this->container->get(Capsule::class);
        $this->repository = new CommentDatabaseRepository($this->database);

        $this->factory = $this->container->get(CommentFactory::class);
        $userFactory = $this->container->get(UserFactory::class);

        $this->user = $userFactory->create();
        $this->cleanupIds['users'][] = $this->user->id();
    }

    /**
     * @test
     */
    public function it_finds_a_comment_by_id()
    {
        $expectedComment = $this->factory->create(
            [
                'author_id' => $this->user->id()
            ]
        );
        $this->cleanupIds['comments'][] = $expectedComment->id();

        $comment = $this->repository->find($expectedComment->id());

        $this->assertInstanceOf(Comment::class, $comment);
        $this->assertEquals($comment->id(), $expectedComment->id());
        $this->assertEquals($comment->content(), $expectedComment->content());
        $this->assertEquals($comment->authorId(), $expectedComment->authorId());
    }

    /**
     * @test
     */
    public function it_can_save_a_comment_object()
    {
        $expectedComment = $this->factory->make(
            [
                'author_id' => $this->user->id()
            ]
        );
        $this->cleanupIds['comments'][] = $expectedComment->id();

        $this->repository->save($expectedComment);

        $record = $this->database::table('comments')
            ->select('*')
            ->where('id', $expectedComment->id())
            ->get();

        $this->assertEquals($record[0]->id, $expectedComment->id());
        $this->assertEquals($record[0]->author_id, $expectedComment->authorId());
        $this->assertEquals($record[0]->content, $expectedComment->content());
    }

    /**
     * @test
     */
    public function it_can_find_comments_by_an_author_id()
    {
        $expectedComment1 = $this->factory->create(
            [
                'author_id' => $this->user->id()
            ]
        );
        $this->cleanupIds['comments'][] = $expectedComment1->id();

        $expectedComment2 = $this->factory->create(
            [
                'author_id' => $this->user->id()
            ]
        );
        $this->cleanupIds['comments'][] = $expectedComment2->id();

        $comments = $this->repository->findByAuthorId($this->user->id());

        $this->assertEquals(2, count($comments));
        $this->assertInstanceOf(Comment::class, $comments[0]);
    }

    public function tearDown(): void
    {
        // Cleanup Database
        $this->database::table('comments')->whereIn('author_id', $this->cleanupIds['comments'])->delete();
        $this->database::table('users')->whereIn('id', $this->cleanupIds['users'])->delete();

        unset($this->cleanupIds);
        unset($this->repository);
        unset($this->database);
        unset($this->factory);
    }
}
