<?php

namespace App\Tests;

use App\Actions\Categories\DeleteAction;
use App\Actions\Categories\StoreAction;
use App\Actions\Categories\UpdateAction;
use App\Entity\Category;
use App\Tests\Traits\Main;
use App\Tests\Fixture\CategoryFixtures;
use App\Repository\CategoryRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Throwable;

class CategoryTest extends KernelTestCase
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
        $this->categoryRepository = static::getContainer()->get(CategoryRepository::class);
        $this->deleteAction = static::getContainer()->get(DeleteAction::class);
        $this->storeAction = static::getContainer()->get(StoreAction::class);
        $this->updateAction = static::getContainer()->get(UpdateAction::class);
    }

    /**
     * Test get category
     *
     * @throws Throwable
     */
    public function testShow()
    {
        $loadFixture = [
            CategoryFixtures::class,
        ];

        $executor = $this->loadFixtures($loadFixture);
        $categoryFirst = $this->getReference($executor, CategoryFixtures::REFERENCE . CategoryFixtures::CATEGORY_NAME_FIRST);
        $categoryExecutor = $this->categoryRepository->find($categoryFirst->getId());

        $this->assertEquals($categoryFirst, $categoryExecutor);
    }

    /**
     * Test create category
     *
     * @throws Throwable
     */
    public function testStore()
    {
        $loadFixture = [
            CategoryFixtures::class,
        ];

        $this->loadFixtures($loadFixture);

        $categories = $this->categoryRepository->findAll();
        $this->assertCount(2, $categories);

        $item = $this->prepareArray();
        $this->storeAction->handle($item);

        $categories = $this->categoryRepository->findAll();
        $this->assertCount(3, $categories);

        $newCategory = $this->categoryRepository->findBy($item);
        $this->assertIsArray($newCategory);

    }

    /**
     * Test update category
     *
     * @throws Throwable
     */
    public function testUpdate()
    {
        $loadFixture = [
            CategoryFixtures::class,
        ];

        $executor = $this->loadFixtures($loadFixture);
        $categorySecond = $this->getReference($executor, CategoryFixtures::REFERENCE . CategoryFixtures::CATEGORY_NAME_SECOND);
        $item = $this->prepareArray();

        $this->updateAction->handle($categorySecond->getId(), $item);
        $categoryUpdate = $this->categoryRepository->find($categorySecond->getId());
        $this->assertEquals($categoryUpdate->getName(), $item['name']);
        $this->assertEquals($categoryUpdate->getDescription(), $item['description']);
        $this->assertEquals($categoryUpdate->getSlug(), $item['slug']);
        $this->assertEquals($categoryUpdate->getSort(), $item['sort']);
    }

    /**
     * Test get all categories
     *
     * @throws Throwable
     */
    public function testIndex()
    {
        $loadFixture = [
            CategoryFixtures::class,
        ];
        $this->loadFixtures($loadFixture);

        $categories = $this->categoryRepository->findAll();
        $this->assertCount(2, $categories);
    }

    /**
     * Test delete category
     *
     * @throws Throwable
     */
    public function testDelete()
    {
        $loadFixture = [
            CategoryFixtures::class,
        ];

        $executor = $this->loadFixtures($loadFixture);
        $categorySecond = $this->getReference($executor, CategoryFixtures::REFERENCE . CategoryFixtures::CATEGORY_NAME_SECOND);
        $this->deleteAction->handle($categorySecond);
        $categories = $this->categoryRepository->findAll();
        $categoryFirst = $this->getReference($executor, CategoryFixtures::REFERENCE . CategoryFixtures::CATEGORY_NAME_FIRST);
        $category = $this->categoryRepository->find($categoryFirst->getId());

        $this->assertEquals($category, $categoryFirst);
        $this->assertCount(1, $categories);
    }

    /**
     * Prepared data for change in DB
     *
     * @return array
     */
    public function prepareArray(): array
    {
        return [
            'name'        => 'new name',
            'description' => 'new descriptions',
            'slug'        => 'new-slug',
            'sort'        => 100,
        ];
    }
}