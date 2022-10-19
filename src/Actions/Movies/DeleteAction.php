<?php

namespace App\Actions\Movies;

use App\Entity\Movie;
use App\Repository\MovieRepository;

/**
 * Class DeleteAction
 * @package App\Actions\Categories
 */
class DeleteAction
{
    public function __construct(
        protected MovieRepository $movieRepository,
    )
    {
    }

    public function handle(Movie $movie): void
    {
        $this->movieRepository->remove($movie, true);
    }
}
