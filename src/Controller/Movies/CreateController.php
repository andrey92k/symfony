<?php

namespace App\Controller\Movies;

use App\Entity\Movie;
use App\Form\MovieFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateController
 *
 * @package App\Controller\Movies
 */
class CreateController extends AbstractController
{
    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(): Response
    {
        $movie = new Movie();
        
        $form = $this->createForm(MovieFormType::class, $movie);

        return $this->renderForm('movies/create.html.twig', [
            'form' => $form,
        ]);
    }
}
