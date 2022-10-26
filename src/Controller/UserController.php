<?php

namespace App\Controller;

use App\Actions\Users\DeleteAction;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class UserController
 *
 * @package App\Controller
 */
class UserController extends AbstractController
{
    protected $user;

    public function __construct(
        protected userRepository $userRepository,
        protected DeleteAction $deleteAction,
    )
    {
        $this->user = new User();
    }

    /**
     * Get all users
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function index()
    {
        $users = $this->userRepository->findAll();

        return $this->render('users/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * Get user
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function show(User $user)
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * Delete user
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function delete(User $user)
    {
        $this->deleteAction->handle($user);

        return $this->redirectToRoute('user_list');
    }
}
