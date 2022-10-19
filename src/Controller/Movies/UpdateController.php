<?php

namespace App\Controller\Movies;

use App\Actions\Movies\UpdateAction;
use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateController
 *
 * @package App\Controller\Movies
 */
class UpdateController extends AbstractController
{
    /**
     * Get users action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(Movie $movie, Request $request, UpdateAction $action)
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

        $action->handle($movie->getId(), $items);

        return $this->redirectToRoute('movie_list');
    }
}
