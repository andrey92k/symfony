<?php

namespace App\Controller\Actors;

use App\Actions\Actors\StoreAction;
use App\Entity\Actor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateController
 *
 * @package App\Controller\Categories
 */
class StoreController extends AbstractController
{
    /**
     * Store actors action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(Request $request, StoreAction $action)
    {
        $data = $request->request->all()['actor_form'];

        $items = [
            'fullName'    => $data['fullName'],
            'description' => $data['description'],
            'slug'        => $data['slug'],
            'birthday'    => new \DateTime(implode('-', $data['birthday'])),
            'birthplace'  => $data['birthplace'],
        ];

        $action->handle($items);

        return $this->redirectToRoute('actor_list');
    }
}
