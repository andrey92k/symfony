<?php

namespace App\Actions\Actors;

use App\Entity\Actor;
use App\Repository\ActorRepository;

/**
 * Class DeleteAction
 * @package App\Actions\Actors
 */
class DeleteAction
{
    public function __construct(
        protected ActorRepository $actorRepository,
    )
    {
    }

    public function handle(Actor $actor): void
    {
        $this->actorRepository->remove($actor, true);
    }
}
