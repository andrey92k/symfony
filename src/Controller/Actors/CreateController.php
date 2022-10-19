<?php

namespace App\Controller\Actors;

use App\Entity\Actor;
use App\Form\ActorFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateController
 *
 * @package App\Controller\Actors
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
        $movie = new Actor();
        
        $form = $this->createForm(ActorFormType::class, $movie);

        return $this->renderForm('actors/create.html.twig', [
            'form' => $form,
        ]);
    }
}
