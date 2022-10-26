<?php

namespace App\Controller;

use App\Form\MovieSearchFormType;
use App\Service\OmdbService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Users
 */
class ApiSearchMoviesController extends AbstractController
{
    const LIMIT = 10;

    public function __construct(
        protected OmdbService $service
    )
    {
    }

    public function index()
    {
        $form = $this->getMovieSearchForm();

        return $this->renderForm('api_search_movies/index.html.twig', [
            'form' => $form,
        ]);
    }

    public function searchByTitle(Request $request)
    {
        $data = $request->query->all()['movie_search_form'] ?? $request->query->all();
        $movies = $this->service->searchByTitle($data);
        $form = $this->getMovieSearchForm();
        if ($movies['Response'] == 'True') {

            return $this->renderForm('api_search_movies/index.html.twig', [
                'form'   => $form,
                'movies' => $movies['Search'],
                'pages'  => ceil($movies['totalResults'] / self::LIMIT),
                'data'   => $data
            ]);
        }

        return $this->renderForm('api_search_movies/index.html.twig', [
            'form' => $form,
        ]);
    }

    public function showByImdbId($imdb_id)
    {
        $movie = $this->service->showByImdbId($imdb_id);

        return $this->renderForm('api_search_movies/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    public function getMovieSearchForm()
    {
        return $this->createForm(MovieSearchFormType::class, []);
    }
}
