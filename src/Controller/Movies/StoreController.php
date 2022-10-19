<?php

namespace App\Controller\Movies;

use App\Actions\Movies\StoreAction;
use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateController
 *
 * @package App\Controller\Categories
 */
class StoreController extends AbstractController
{
    /**
     * Get users action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(Request $request, StoreAction $action)
    {
        $data = $request->request->all()['movie_form'];

        $items = [
            'name'         => $data['name'],
            'description'  => $data['description'],
            'slug'         => $data['slug'],
            'frame'        => $data['frame'],
            'data_release' => new \DateTime(implode('-', $data['data_release'])),
            'category'     => $data['category'],
            'actor'        => $data['actor'],
        ];

        $action->handle($items);

        return $this->redirectToRoute('movie_list');
    }
}
