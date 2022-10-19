<?php

namespace App\Controller\Movies;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AllController
 *
 * @package App\Controller\Movies
 */
class AllController extends AbstractController
{
    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();

        return $this->render('movies/index.html.twig', [
            'movies' => $movies,
        ]);
    }
}
