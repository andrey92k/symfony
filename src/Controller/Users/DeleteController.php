<?php

namespace App\Controller\Users;

use App\Actions\Users\DeleteAction;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Users
 */
class DeleteController extends AbstractController
{
    /**
     * Get users action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(User $user, DeleteAction $action)
    {
        $action->handle($user);
        return $this->redirectToRoute('user_list');
    }
}
