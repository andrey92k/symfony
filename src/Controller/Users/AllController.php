<?php

namespace App\Controller\Users;

use App\Repository\UserRepository;
use App\Resource\UserResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Users
 */
class AllController extends AbstractController
{
    /**
     * Get users action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('users/index.html.twig', [
            'users' => $users,
        ]);
    }
}
