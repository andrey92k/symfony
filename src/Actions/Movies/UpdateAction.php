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
        $this->movieRepository->update($id, $data);
    }
}
