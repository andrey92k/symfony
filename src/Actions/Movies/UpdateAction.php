<?php

namespace App\Actions\Movies;

use App\Repository\MovieRepository;

/**
 * Class UpdateAction
 * @package App\Actions\Movies
 */
class UpdateAction
{
    public function __construct(
        protected MovieRepository $movieRepository,
    )
    {
    }

    public function handle($id, array $data): void
    {
        $items = [
            'name'         => $data['name'],
            'description'  => $data['description'],
            'slug'         => $data['slug'],
            'frame'        => $data['frame'],
            'data_release' => new \DateTime(implode('-', $data['data_release'])),
            'category'     => $data['category'],
            'actor'        => $data['actor'],
        ];

        $this->movieRepository->update($id, $items);
    }
}
