<?php

namespace App\Tests\Fixture;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    const REFERENCE = 'actor-';
    const ACTOR_NAME_FIRST = 'Jonny Depp';
    const ACTOR_NAME_SECOND = 'Tom Cruz';

    public function load(ObjectManager $manager): void
    {
        $actors = [
            [
                'full_name'   => self::ACTOR_NAME_FIRST,
                'description' => 'Description',
                'slug'        => 'slug',
                'birthday'    => '1992-01-01',
                'birthplace'  => 'New York',
            ],
            [
                'full_name'   => self::ACTOR_NAME_SECOND,
                'description' => 'Description2',
                'slug'        => 'slug2',
                'birthday'    => '1995-01-01',
                'birthplace'  => 'Los Angeles',
            ]
        ];

        foreach ($actors as $item) {
            $actor = new Actor();
            $actor->setFullName($item['full_name']);
            $actor->setSlug($item['slug']);
            $actor->setBirthday(new \DateTime($item['birthday']));
            $actor->setBirthplace($item['birthplace']);

            $manager->persist($actor);
            $manager->flush();

            $this->addReference(self::REFERENCE . $item['full_name'], $actor);
        }
    }
}
