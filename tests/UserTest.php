<?php

namespace App\Tests;

use App\Actions\Users\DeleteAction;
use App\Tests\Fixture\UserFixtures;
use App\Repository\UserRepository;
use App\Tests\Traits\Main;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Throwable;

class UserTest extends KernelTestCase
{
    use Main;

    /** @var AbstractDatabaseTool */
    protected $databaseTool;
    protected $repository;
    protected $deleteAction;

    /**
     * Set up
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->userRepository = static::getContainer()->get(UserRepository::class);
        $this->deleteAction = static::getContainer()->get(DeleteAction::class);
    }

    /**
     * Test get user
     *
     * @throws Throwable
     */
    public function testShow()
    {
        $loadFixture = [
            UserFixtures::class,
        ];
        $executor = $this->loadFixtures($loadFixture);
        $user = $this->getReference($executor, UserFixtures::REFERENCE . UserFixtures::USER_EMAIL_FIRST);
        $userExecutor = $this->userRepository->find($user->getId());

        $this->assertEquals($user, $userExecutor);
    }

    /**
     * Test get all users
     *
     * @throws Throwable
     */
    public function testIndex()
    {
        $loadFixture = [
            UserFixtures::class,
        ];
        $this->loadFixtures($loadFixture);

        $users = $this->userRepository->findAll();
        $this->assertCount(2, $users);
    }

    /**
     * Test delete user
     *
     * @throws Throwable
     */
    public function testDelete()
    {
        $loadFixture = [
            UserFixtures::class,
        ];
        $executor = $this->loadFixtures($loadFixture);

        $user = $this->getReference($executor, UserFixtures::REFERENCE . UserFixtures::USER_EMAIL_FIRST);
        $this->deleteAction->handle($user);
        $users = $this->userRepository->findAll();

        $this->assertCount(1, $users);
    }
}