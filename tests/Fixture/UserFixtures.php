<?php

namespace  App\Tests\Fixture;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    const REFERENCE = 'user-';
    const USER_EMAIL_FIRST = 'test@test.ua';
    const USER_EMAIL_SECOND = 'test2@test.ua';

    public function load(ObjectManager $manager): void
    {
        $users = [
            [
                'email'       => self::USER_EMAIL_FIRST,
                'password'    => 'password',
                'is_verified' => true
            ],
            [
                'email'       => self::USER_EMAIL_SECOND,
                'password'    => 'password2',
                'is_verified' => false
            ]
        ];

        foreach ($users as $item) {
            $user = new User();
            $user->setEmail($item['email']);
            $user->setPassword($item['password']);
            $user->setIsVerified(true);
            $manager->persist($user);
            $manager->flush();

            $this->addReference(self::REFERENCE . $item['email'], $user);
        }
    }
}
