<?php

namespace App\Controller\Actors;

use App\Entity\Actor;
use App\Form\ActorFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Actors
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
    public function __invoke(Actor $movie)
    {
        $form = $this->createForm(ActorFormType::class, $movie);

        return $this->renderForm('actors/show.html.twig', [
            'form' => $form,
            'id'   => $movie->getId()
        ]);
    }
}
