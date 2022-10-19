<?php

namespace App\Actions\Actors;

use App\Repository\ActorRepository;

/**
 * Class UpdateAction
 * @package App\Actions\Actors
 */
class UpdateAction
{
    public function __construct(
        protected ActorRepository $actorRepository,
    )
    {
    }

    public function handle($id, array $data): void
    {
        $this->actorRepository->update($id, $data);
    }
}
