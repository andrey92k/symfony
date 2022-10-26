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
        $items = [
            'name'        => $data['name'],
            'description' => $data['description'],
            'slug'        => $data['slug'],
            'sort'        => $data['sort'],
        ];

        $this->categoryRepository->update($id, $items);
    }
}
