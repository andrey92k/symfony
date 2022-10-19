<?php

namespace App\Controller\Categories;

use App\Actions\Categories\DeleteAction;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Categories
 */
class DeleteController extends AbstractController
{
    /**
     * Get users action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(Category $category, DeleteAction $action)
    {
        $action->handle($category);

        return $this->redirectToRoute('categories_list');
    }
}
