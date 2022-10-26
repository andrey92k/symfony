<?php

namespace App\Controller;

use App\Actions\Actors\DeleteAction;
use App\Actions\Actors\StoreAction;
use App\Actions\Actors\UpdateAction;
use App\Entity\Actor;
use App\Form\ActorFormType;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AllController
 *
 * @package App\Controller
 */
class ActorController extends AbstractController
{
    protected $actor;

    public function __construct(
        protected ActorRepository $actorRepository,
        protected StoreAction $storeAction,
        protected UpdateAction $updateAction,
        protected DeleteAction $deleteAction,
    )
    {
        $this->actor = new Actor();
    }

    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function index(): Response
    {
        $actors = $this->actorRepository->findAll();

        return $this->render('actors/index.html.twig', [
            'actors' => $actors,
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
        $form = $this->createForm(ActorFormType::class, $this->actor);

        return $this->renderForm('actors/create.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function show(Actor $actor): Response
    {
        $form = $this->createForm(ActorFormType::class, $actor);

        return $this->renderForm('actors/show.html.twig', [
            'form' => $form,
            'id'   => $actor->getId()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->request->all()['actor_form'];
        $this->storeAction->handle($data);

        return $this->redirectToRoute('actor_list');
    }

    public function update(Actor $actor, Request $request)
    {
        $data = $request->request->all()['actor_form'];
        $this->updateAction->handle($actor->getId(), $data);

        return $this->redirectToRoute('actor_list');
    }

    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function delete(Actor $actor): Response
    {
        $this->deleteAction->handle($actor);

        return $this->redirectToRoute('actor_list');
    }
}
