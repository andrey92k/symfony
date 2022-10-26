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
        $items = [
            'name'        => $data['name'],
            'description' => $data['description'],
            'slug'        => $data['slug'],
            'sort'        => $data['sort'],
        ];

        $this->categoryRepository->store($items);
    }
}
