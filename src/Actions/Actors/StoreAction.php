<?php

namespace App\Actions\Actors;

use App\Repository\ActorRepository;

/**
 * Class StoreAction
 * @package App\Actions\Actors
 */
class StoreAction
{
    public function __construct(
        protected ActorRepository $actorRepository,
    )
    {
    }

    public function handle(array $data): void
    {
        $this->actorRepository->store($data);
    }
}
