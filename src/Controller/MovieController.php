<?php

namespace App\Controller;

use App\Actions\Comments\AllMovieCommentAction;
use App\Actions\Movies\DeleteAction;
use App\Actions\Movies\StoreAction;
use App\Actions\Movies\UpdateAction;
use App\Entity\Movie;
use App\Form\CommentFormType;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AllController
 *
 * @package App\Controller
 */
class MovieController extends AbstractController
{
    protected $movie;

    public function __construct(
        protected movieRepository $movieRepository,
        protected StoreAction $storeAction,
        protected UpdateAction $updateAction,
        protected DeleteAction $deleteAction,
        protected AllMovieCommentAction $comments
    )
    {
        $this->movie = new Movie();
    }

    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();

        return $this->render('movies/index.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function create(): Response
    {
        $form = $this->createForm(MovieFormType::class, $this->movie);

        return $this->renderForm('movies/create.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * show movie
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function show(Movie $movie)
    {
        $form = $this->createForm(MovieFormType::class, $movie);
        $commentForm = $this->createForm(CommentFormType::class, $movie);
        $comments = $this->comments->handle($movie->getId());

        return $this->renderForm('movies/show.html.twig', [
            'form'        => $form,
            'id'          => $movie->getId(),
            'commentForm' => $commentForm,
            'comments'    => $comments
        ]);
    }

    /**
     * update store
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $data = $request->request->all()['movie_form'];
        $this->storeAction->handle($data);

        return $this->redirectToRoute('movie_list');
    }

    /**
     * update movie
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function update(Movie $movie, Request $request)
    {
        $data = $request->request->all()['movie_form'];
        $this->updateAction->handle($movie->getId(), $data);

        return $this->redirectToRoute('movie_list');
    }

    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function delete(Movie $movie)
    {
        $this->deleteAction->handle($movie);

        return $this->redirectToRoute('movie_list');
    }
}