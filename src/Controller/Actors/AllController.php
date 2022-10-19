<?php

namespace App\Controller\Actors;

use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AllController
 *
 * @package App\Controller\Actors
 */
class AllController extends AbstractController
{
    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAll();

        return $this->render('actors/index.html.twig', [
            'actors' => $actors,
        ]);
    }
}
