<?php

namespace App\Controller\Movies;

use App\Entity\Movie;
use App\Form\MovieFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Categories
 */
class ShowController extends AbstractController
{
    /**
     * Get movies action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(Movie $movie)
    {

        $form = $this->createForm(MovieFormType::class, $movie);

        return $this->renderForm('movies/show.html.twig', [
            'form' => $form,
            'id'   => $movie->getId()
        ]);
    }
}
