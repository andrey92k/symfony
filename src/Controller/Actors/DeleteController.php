<?php

namespace App\Controller\Actors;

use App\Actions\Actors\DeleteAction;
use App\Entity\Actor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Movies
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
    public function __invoke(Actor $actor, DeleteAction $action)
    {
        $action->handle($actor);

        return $this->redirectToRoute('actor_list');
    }
}
