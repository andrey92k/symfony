<?php

namespace App\Tests;

use App\Actions\Actors\DeleteAction;
use App\Actions\Actors\StoreAction;
use App\Actions\Actors\UpdateAction;
use App\Tests\Traits\Main;
use App\Tests\Fixture\ActorFixtures;
use App\Repository\ActorRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Throwable;

class ActorTest extends KernelTestCase
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
        $this->actorRepository = static::getContainer()->get(ActorRepository::class);
        $this->deleteAction = static::getContainer()->get(DeleteAction::class);
        $this->storeAction = static::getContainer()->get(StoreAction::class);
        $this->updateAction = static::getContainer()->get(UpdateAction::class);
    }

    /**
     * Test get actor
     *
     * @throws Throwable
     */
    public function testShow()
    {
        $loadFixture = [
            ActorFixtures::class,
        ];

        $executor = $this->loadFixtures($loadFixture);
        $actorFirst = $this->getReference($executor, ActorFixtures::REFERENCE . ActorFixtures::ACTOR_NAME_FIRST);
        $actorExecutor = $this->actorRepository->find($actorFirst->getId());

        $this->assertEquals($actorFirst, $actorExecutor);
    }

    /**
     * Test create category
     *
     * @throws Throwable
     */
    public function testStore()
    {
        $loadFixture = [
            ActorFixtures::class,
        ];

        $this->loadFixtures($loadFixture);

        $actors = $this->actorRepository->findAll();
        $this->assertCount(2, $actors);

        $item = $this->prepareArray();
        $this->storeAction->handle($item);

        $actors = $this->actorRepository->findAll();
        $this->assertCount(3, $actors);

        $newActor = $this->actorRepository->findBy([
            'full_name' =>  $item['fullName'],
            'slug'     => $item['slug'],
        ]);

        $this->assertIsArray($newActor);
    }

    /**
     * Test update category
     *
     * @throws Throwable
     */
    public function testUpdate()
    {
        $loadFixture = [
            ActorFixtures::class,
        ];

        $executor = $this->loadFixtures($loadFixture);
        $actorSecond = $this->getReference($executor, ActorFixtures::REFERENCE . ActorFixtures::ACTOR_NAME_SECOND);
        $item = $this->prepareArray();

        $this->updateAction->handle($actorSecond->getId(), $item);
        $actorUpdate = $this->actorRepository->find($actorSecond->getId());
        $this->assertEquals($actorUpdate->getFullName(), $item['fullName']);
        $this->assertEquals($actorUpdate->getDescription(), $item['description']);
        $this->assertEquals($actorUpdate->getSlug(), $item['slug']);
        $this->assertEquals($actorUpdate->getBirthday(), new \DateTime($item['birthday']));
        $this->assertEquals($actorUpdate->getBirthplace(), $item['birthplace']);
    }

    /**
     * Test get all categories
     *
     * @throws Throwable
     */
    public function testIndex()
    {
        $loadFixture = [
            ActorFixtures::class,
        ];
        $this->loadFixtures($loadFixture);

        $actors = $this->actorRepository->findAll();
        $this->assertCount(2, $actors);
    }

    /**
     * Test delete category
     *
     * @throws Throwable
     */
    public function testDelete()
    {
        $loadFixture = [
            ActorFixtures::class,
        ];

        $executor = $this->loadFixtures($loadFixture);
        $actorSecond = $this->getReference($executor, ActorFixtures::REFERENCE . ActorFixtures::ACTOR_NAME_SECOND);
        $this->deleteAction->handle($actorSecond);
        $actors = $this->actorRepository->findAll();
        $actorFirst = $this->getReference($executor, ActorFixtures::REFERENCE . ActorFixtures::ACTOR_NAME_FIRST);
        $actor = $this->actorRepository->find($actorFirst->getId());

        $this->assertEquals($actor, $actorFirst);
        $this->assertCount(1, $actors);
    }

    /**
     * Prepared data for change in DB
     *
     * @return array
     */
    public function prepareArray(): array
    {
        return [
            'fullName'    => 'new Full Name',
            'description' => 'new description',
            'slug'        => 'new-slug',
            'birthday'    => '1985-10-11',
            'birthplace'  => 'New Paris',
        ];
    }
}