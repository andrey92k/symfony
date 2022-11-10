<?php

namespace App\Tests\Fixture;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    const REFERENCE = 'movie-';
    const MOVIE_NAME_FIRST = 'Lord of the Ring';
    const MOVIE_NAME_SECOND = 'Harry Potter';
    const CATEGORY_REFERENCE_FIRST = CategoryFixtures::REFERENCE . CategoryFixtures::CATEGORY_NAME_FIRST;
    const CATEGORY_REFERENCE_SECOND = CategoryFixtures::REFERENCE . CategoryFixtures::CATEGORY_NAME_SECOND;
    const ACTOR_REFERENCE_FIRST = ActorFixtures::REFERENCE . ActorFixtures::ACTOR_NAME_FIRST;
    const ACTOR_REFERENCE_SECOND = ActorFixtures::REFERENCE . ActorFixtures::ACTOR_NAME_SECOND;

    public function load(ObjectManager $manager): void
    {
        $movies = [
            [
                'name'         => self::MOVIE_NAME_FIRST,
                'description'  => 'description',
                'slug'         => 'slug',
                'data_release' => '2015-01-01',
                'frame'        => 'frame 1',
                'categories'     => [
                    $this->getReference(self::CATEGORY_REFERENCE_FIRST)->getId()
                ],
                'actors'     => [
                    $this->getReference(self::ACTOR_REFERENCE_FIRST)->getId(),
                    $this->getReference(self::ACTOR_REFERENCE_SECOND)->getId()
                ],
            ],
            [
                'name'         => self::MOVIE_NAME_SECOND,
                'description'  => 'description 2',
                'slug'         => 'slug2',
                'data_release' => '2017-01-01',
                'frame'        => 'frame 2',
                'categories'     => [
                    $this->getReference(self::CATEGORY_REFERENCE_FIRST)->getId(),
                    $this->getReference(self::CATEGORY_REFERENCE_SECOND)->getId(),
                ],
                'actors'     => [
                    $this->getReference(self::ACTOR_REFERENCE_SECOND)->getId()
                ],
            ]
        ];

        foreach ($movies as $item) {
            $movie = new Movie();
            $movie->setName($item['name']);
            $movie->setDescription($item['description']);
            $movie->setSlug($item['slug']);
            $movie->setDataRelease(new \DateTime($item['data_release']));

            foreach ($item['categories'] as $value) {
                $category = $manager->getRepository(Category::class)->find($value);
                $movie->addCategory($category);
            }

            foreach ($item['actors'] as $value) {
                $actor = $manager->getRepository(Actor::class)->find($value);
                $movie->addActor($actor);
            }

            $manager->persist($movie);
            $manager->flush();

            $this->addReference(self::REFERENCE . $item['name'], $movie);
        }
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            ActorFixtures::class,
        ];
    }
}
