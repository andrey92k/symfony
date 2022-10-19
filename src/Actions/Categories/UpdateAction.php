<?php

namespace App\Actions\Categories;

use App\Repository\CategoryRepository;

/**
 * Class UpdateAction
 * @package App\Actions\Categories
 */
class UpdateAction
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    )
    {
    }

    public function handle($id, array $data): void
    {
        $this->categoryRepository->update($id, $data);
    }
}
