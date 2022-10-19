<?php

namespace App\Controller\Movies;

use App\Actions\Movies\DeleteAction;
use App\Entity\Movie;
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
    public function __invoke(Movie $movie, DeleteAction $action)
    {
        $action->handle($movie);

        return $this->redirectToRoute('movie_list');
    }
}
