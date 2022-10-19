<?php

namespace App\Controller\Actors;

use App\Actions\Actors\UpdateAction;
use App\Entity\Actor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UpdateController
 *
 * @package App\Controller\Actors
 */
class UpdateController extends AbstractController
{
    /**
     * Update user action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(Actor $actor, Request $request, UpdateAction $action)
    {
        $data = $request->request->all()['actor_form'];

        $items = [
            'fullName'    => $data['fullName'],
            'description' => $data['description'],
            'slug'        => $data['slug'],
            'birthday'    => new \DateTime(implode('-', $data['birthday'])),
            'birthplace'  => $data['birthplace'],
        ];

        $action->handle($actor->getId(), $items);

        return $this->redirectToRoute('actor_list');
    }
}
