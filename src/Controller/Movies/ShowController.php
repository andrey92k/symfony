<?php

namespace App\Controller\Movies;

use App\Actions\Comments\AllMovieCommentAction;
use App\Entity\Movie;
use App\Form\CommentFormType;
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
    public function __invoke(Movie $movie, AllMovieCommentAction $comments)
    {
        $form = $this->createForm(MovieFormType::class, $movie);
        $commentForm = $this->createForm(CommentFormType::class, $movie);
        $comments = $comments->handle($movie->getId());

        return $this->renderForm('movies/show.html.twig', [
            'form'        => $form,
            'id'          => $movie->getId(),
            'commentForm' => $commentForm,
            'comments'    => $comments
        ]);
    }
}
