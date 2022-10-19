<?php

namespace App\Actions\Categories;

use App\Repository\CategoryRepository;

/**
 * Class StoreAction
 * @package App\Actions\Categories
 */
class StoreAction
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    )
    {
    }

    public function handle(array $data): void
    {
        $this->categoryRepository->store($data);
    }
}
