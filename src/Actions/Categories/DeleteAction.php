<?php

namespace App\Actions\Categories;

use App\Entity\Category;
use App\Repository\CategoryRepository;

/**
 * Class DeleteAction
 * @package App\Actions\Categories
 */
class DeleteAction
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    )
    {
    }

    public function handle(Category $category): void
    {
        $this->categoryRepository->remove($category, true);
    }
}
