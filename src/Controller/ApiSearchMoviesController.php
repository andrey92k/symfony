<?php

namespace App\Controller;

use App\AbstractFactory\GuiFactory;
use App\Form\MovieSearchFormType;
use App\Service\OmdbService;
use App\Service\ThemoviedbService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Users
 */
class ApiSearchMoviesController extends AbstractController
{
    const LIMIT_OMDB = 10;
    const LIMIT_THEMOVIEDB = 20;


    public function __construct(
        protected OmdbService       $omdbService,
        protected ThemoviedbService $themoviedbService,
        protected GuiFactory        $factory
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

        switch ($data['select_api']) {
            case 'omdb':

                return $this->getOmdbData($data);
            case 'themoviedb':
                return $this->getThemoviedbData($data);
        }
    }

    public function getOmdbData($data)
    {
        $movies = $this->omdbService->searchByTitle($data);
        $form = $this->getMovieSearchForm();

        if ($movies['Response'] == 'True') {

            return $this->renderForm('api_search_movies/index.html.twig', [
                'form'       => $form,
                'movies_omdb' => $movies['Search'],
                'pages'      => ceil($movies['totalResults'] / self::LIMIT_OMDB),
                'data'       => $data
            ]);
        }

        return $this->renderForm('api_search_movies/index.html.twig', [
            'form' => $form,
        ]);
    }

    public function getThemoviedbData($data)
    {
        $movies = $this->themoviedbService->searchByTitle($data);
        $form = $this->getMovieSearchForm();

        if ($movies['total_results'] > 0) {

            return $this->renderForm('api_search_movies/index.html.twig', [
                'form'              => $form,
                'movies_themoviedb' => $movies['results'],
                'pages'             => $movies['total_pages'],
                'data'              => $data
            ]);
        }

        return $this->renderForm('api_search_movies/index.html.twig', [
            'form' => $form,
        ]);
    }

    public function showByImbdId($imdb_id)
    {
        $movie = $this->omdbService->showById($imdb_id);
        $label = $this->factory->getFactory($movie['Type'])->createLabel()->get();
        $icon = $this->factory->getFactory($movie['Type'])->createIcon()->get();

        return $this->renderForm('api_search_movies/show.html.twig', [
            'movie' => $movie,
            'label' => $label,
            'icon'  => $icon
        ]);
    }

    public function showByThemoviedbId($id)
    {
        $movie = $this->themoviedbService->showById($id);

        return $this->renderForm('api_search_movies/show_themoviedb_api.html.twig', [
            'movie' => $movie,
        ]);
    }

    public function getMovieSearchForm()
    {
        return $this->createForm(MovieSearchFormType::class, []);
    }
}
