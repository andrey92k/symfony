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
        $items = [
            'fullName'    => $data['fullName'],
            'description' => $data['description'],
            'slug'        => $data['slug'],
            'birthday'    => new \DateTime(implode('-', $data['birthday'])),
            'birthplace'  => $data['birthplace'],
        ];

        $this->actorRepository->update($id, $items);
    }
}
