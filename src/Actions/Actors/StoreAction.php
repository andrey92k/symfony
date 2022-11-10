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
        if (is_array($data['birthday'])) {
            $data['birthday'] = implode('-', $data['birthday']);
        }

        $items = [
            'fullName'    => $data['fullName'],
            'description' => $data['description'],
            'slug'        => $data['slug'],
            'birthday'    => new \DateTime($data['birthday']),
            'birthplace'  => $data['birthplace'],
        ];

        $this->actorRepository->store($items);
    }
}
