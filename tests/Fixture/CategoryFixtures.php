<?php

namespace App\Tests\Fixture;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const REFERENCE = 'category-';
    const CATEGORY_NAME_FIRST = 'Thriller';
    const CATEGORY_NAME_SECOND = 'Fantasy';

    public function load(ObjectManager $manager): void
    {
        $categories = [
            [
                'name'        => self::CATEGORY_NAME_FIRST,
                'description' => 'description',
                'slug'        => 'slug',
                'sort'        => 10
            ],
            [
                'name'        => self::CATEGORY_NAME_SECOND,
                'description' => 'description 2',
                'slug'        => 'slug2',
                'sort'        => 10
            ]
        ];

        foreach ($categories as $item) {
            $category = new Category();
            $category->setName($item['name']);
            $category->setDescription($item['description']);
            $category->setSlug($item['slug']);
            $category->setSort($item['sort']);

            $manager->persist($category);
            $manager->flush();

            $this->addReference(self::REFERENCE . $item['name'], $category);
        }
    }
}
