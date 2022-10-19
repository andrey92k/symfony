<?php

namespace App\Controller\Categories;

use App\Actions\Categories\StoreAction;
use App\Actions\Categories\UpdateAction;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateController
 *
 * @package App\Controller\Categories
 */
class UpdateController extends AbstractController
{
    /**
     * Get users action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(Category $category, Request $request, UpdateAction $action)
    {
        $data = $request->request->all()['category_form'];

        $category_array = [
            'name'        => $data['name'],
            'description' => $data['description'],
            'slug'        => $data['slug'],
            'sort'        => $data['sort'],
        ];

        $action->handle($category->getId(), $category_array);

        return $this->redirectToRoute('categories_list');
    }
}
