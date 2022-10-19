<?php

namespace App\Controller\Categories;

use App\Entity\Category;
use App\Form\CategoryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Categories
 */
class ShowController extends AbstractController
{
    /**
     * Get categories action
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(Category $category)
    {
        $form = $this->createForm(CategoryFormType::class, $category);

        return $this->renderForm('categories/show.html.twig', [
            'form' => $form,
            'id'   => $category->getId()
        ]);
    }
}
