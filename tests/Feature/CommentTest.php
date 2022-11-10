<?php

namespace App\Tests\Feature;

use App\Actions\Comments\AllMovieCommentAction;
use App\Actions\Comments\StoreAction;
use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use App\Tests\Fixture\MovieFixtures;
use App\Tests\Fixture\UserFixtures;
use App\Tests\Traits\Main;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Throwable;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CommentTest extends WebTestCase
{
    use Main;

    /**
     * Set up
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->userRepository = static::getContainer()->get(UserRepository::class);
        $this->movieRepository = static::getContainer()->get(MovieRepository::class);
        $this->storeAction = static::getContainer()->get(StoreAction::class);
        $this->allMovieCommentAction = static::getContainer()->get(AllMovieCommentAction::class);
    }

    /**
     * Test get user
     *
     * @throws Throwable
     */
    public function testStore()
    {
        $loadFixture = [
            UserFixtures::class,
            MovieFixtures::class,
        ];
        $executor = $this->loadFixtures($loadFixture);

        $user = $this->getReference($executor, UserFixtures::REFERENCE . UserFixtures::USER_EMAIL_FIRST);
        $userExecutor = $this->userRepository->find($user->getId());
        $this->assertEquals($user, $userExecutor);
        $this->client->loginUser($userExecutor);

        $movieFirst = $this->getReference($executor, MovieFixtures::REFERENCE . MovieFixtures::MOVIE_NAME_FIRST);
        $movieExecutor = $this->movieRepository->find($movieFirst->getId());

        $this->assertEquals($movieFirst, $movieExecutor);

        $allComments = $this->allMovieCommentAction->handle($movieFirst->getId());

        $comment = [
            'comment' => 'comment',
            'movie_id' => $movieFirst->getId()
        ];

        $this->storeAction->handle($comment, $userExecutor, 60);
        $allNewComments = $this->allMovieCommentAction->handle($movieFirst->getId());

        $this->assertCount(count($allComments) + 1,  $allNewComments);
    }
}