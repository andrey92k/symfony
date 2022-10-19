<?php

namespace App\Actions\Movies;

use App\Repository\MovieRepository;

/**
 * Class StoreAction
 * @package App\Actions\Categories
 */
class StoreAction
{
    public function __construct(
        protected MovieRepository $movieRepository,
    )
    {
    }

    public function handle(array $data): void
    {
        $this->movieRepository->store($data);
    }
}
