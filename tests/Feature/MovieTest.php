<?php

namespace App\Tests\Feature;

use App\Actions\Movies\DeleteAction;
use App\Actions\Movies\StoreAction;
use App\Actions\Movies\UpdateAction;
use App\Repository\MovieRepository;
use App\Tests\Fixture\ActorFixtures;
use App\Tests\Fixture\CategoryFixtures;
use App\Tests\Fixture\MovieFixtures;
use App\Tests\Traits\Main;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Throwable;

class MovieTest extends KernelTestCase
{
    use Main;

    /** @var AbstractDatabaseTool */
    protected $databaseTool;
    protected $movieRepository;
    protected $deleteAction;
    protected $storeAction;
    protected $updateAction;

    /**
     * Set up
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->movieRepository = static::getContainer()->get(MovieRepository::class);
        $this->deleteAction = static::getContainer()->get(DeleteAction::class);
        $this->storeAction = static::getContainer()->get(StoreAction::class);
        $this->updateAction = static::getContainer()->get(UpdateAction::class);
    }

    /**
     * Test get movie
     *
     * @throws Throwable
     */
    public function testShow()
    {
        $loadFixture = [
            MovieFixtures::class,
        ];

        $executor = $this->loadFixtures($loadFixture);
        $movieFirst = $this->getReference($executor, MovieFixtures::REFERENCE . MovieFixtures::MOVIE_NAME_FIRST);
        $movieExecutor = $this->movieRepository->find($movieFirst->getId());

        $this->assertEquals($movieFirst, $movieExecutor);
    }

    /**
     * Test create movie
     *
     * @throws Throwable
     */
    public function testStore()
    {
        $loadFixture = [
            MovieFixtures::class,
        ];

        $this->loadFixtures($loadFixture);

        $movies = $this->movieRepository->findAll();
        $this->assertCount(2, $movies);

        $item = $this->prepareArray();
        $this->storeAction->handle($item);

        $movies = $this->movieRepository->findAll();
        $this->assertCount(3, $movies);

        $newMovie = $this->movieRepository->findBy([
            'name' => $item['name'],
            'slug' => $item['slug'],
        ]);

        $this->assertIsArray($newMovie);
    }

    /**
     * Test update movie
     *
     * @throws Throwable
     */
    public function testUpdate()
    {
        $loadFixture = [
            MovieFixtures::class,
        ];

        $executor = $this->loadFixtures($loadFixture);
        $movieSecond = $this->getReference($executor, MovieFixtures::REFERENCE . MovieFixtures::MOVIE_NAME_SECOND);
        $item = $this->prepareArray();

        $this->updateAction->handle($movieSecond->getId(), $item);
        $movieUpdate = $this->movieRepository->find($movieSecond->getId());
        $this->assertEquals($movieUpdate->getName(), $item['name']);
        $this->assertEquals($movieUpdate->getDescription(), $item['description']);
        $this->assertEquals($movieUpdate->getSlug(), $item['slug']);
        $this->assertEquals($movieUpdate->getDataRelease(), new \DateTime($item['data_release']));
    }

    /**
     * Test get all movies
     *
     * @throws Throwable
     */
    public function testIndex()
    {
        $loadFixture = [
            MovieFixtures::class,
        ];

        $this->loadFixtures($loadFixture);
        $movies = $this->movieRepository->findAll();
        $this->assertCount(2, $movies);
    }

    /**
     * Test delete movie
     *
     * @throws Throwable
     */
    public function testDelete()
    {
        $loadFixture = [
            MovieFixtures::class,
        ];

        $executor = $this->loadFixtures($loadFixture);
        $movieSecond = $this->getReference($executor, MovieFixtures::REFERENCE . MovieFixtures::MOVIE_NAME_SECOND);
        $this->deleteAction->handle($movieSecond);
        $movies = $this->movieRepository->findAll();
        $movieFirst = $this->getReference($executor, MovieFixtures::REFERENCE . MovieFixtures::MOVIE_NAME_FIRST);
        $movie = $this->movieRepository->find($movieFirst->getId());

        $this->assertEquals($movie, $movieFirst);
        $this->assertCount(1, $movies);
    }

    /**
     * Prepared data for change in DB
     *
     * @return array
     */
    public function prepareArray(): array
    {
        $loadFixture = [
            MovieFixtures::class,
            CategoryFixtures::class,
            ActorFixtures::class
        ];

        $executor = $this->loadFixtures($loadFixture);

        return [
            'name'         => 'new name',
            'description'  => 'new descriptions',
            'slug'         => 'new-slug',
            'data_release' => '2015-01-01',
            'frame'        => 'new frame',
            'categories'     => [
                $this->getReference($executor, MovieFixtures::CATEGORY_REFERENCE_FIRST)->getId(),
                $this->getReference($executor, MovieFixtures::CATEGORY_REFERENCE_SECOND)->getId(),
            ],
            'actors'     => [
                $this->getReference($executor, MovieFixtures::ACTOR_REFERENCE_SECOND)->getId()
            ],
        ];
    }
}