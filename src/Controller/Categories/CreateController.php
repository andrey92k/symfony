<?php

namespace App\Controller\Categories;

use App\Entity\Category;
use App\Form\CategoryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateController
 *
 * @package App\Controller\Categories
 */
class CreateController extends AbstractController
{
    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function __invoke(): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);

        return $this->renderForm('categories/create.html.twig', [
            'form' => $form,
        ]);
    }
}
