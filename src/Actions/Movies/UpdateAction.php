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
        if (is_array($data['data_release'])) {
            $data['data_release'] = implode('-', $data['data_release']);
        }

        $items = [
            'name'         => $data['name'],
            'description'  => $data['description'],
            'slug'         => $data['slug'],
            'frame'        => $data['frame'],
            'data_release' => new \DateTime($data['data_release']),
            'categories'   => $data['categories'],
            'actors'       => $data['actors'],
        ];

        $this->movieRepository->update($id, $items);
    }
}
