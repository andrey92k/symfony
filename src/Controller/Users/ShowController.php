<?php

namespace App\Controller\Users;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Resource\UserResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Users
 */
class ShowController extends AbstractController
{
    /**
     * Get users action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(User $user)
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }
}
