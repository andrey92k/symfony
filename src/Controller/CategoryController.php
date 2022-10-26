<?php

namespace App\Controller;

use App\Actions\Categories\DeleteAction;
use App\Actions\Categories\StoreAction;
use App\Actions\Categories\UpdateAction;
use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryController
 *
 * @package App\Controller
 */
class CategoryController extends AbstractController
{
    protected $category;

    public function __construct(
        protected categoryRepository $categoryRepository,
        protected StoreAction $storeAction,
        protected UpdateAction $updateAction,
        protected DeleteAction $deleteAction,
    )
    {
        $this->category = new Category();
    }

    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function index(): Response
    {
        $categories = $this->categoryRepository->findAll();

        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     *
     * @return
     *
     * @throws \Throwable
     */
    public function create(): Response
    {
        $form = $this->createForm(CategoryFormType::class, $this->category);

        return $this->renderForm('categories/create.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * Show category
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function show(Category $category)
    {
        $form = $this->createForm(CategoryFormType::class, $category);

        return $this->renderForm('categories/show.html.twig', [
            'form' => $form,
            'id'   => $category->getId()
        ]);
    }

    /**
     * Store category
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $data = $request->request->all()['category_form'];
        $this->storeAction->handle($data);

        return $this->redirectToRoute('categories_list');
    }

    /**
     * Update category
     *
     *
     * @return
     *
     * @throws \Throwable
     */
    public function update(Category $category, Request $request)
    {
        $data = $request->request->all()['category_form'];
        $this->updateAction->handle($category->getId(), $data);

        return $this->redirectToRoute('categories_list');
    }

    /**
     * Delete category
     *
     * @return
     *
     * @throws \Throwable
     */
    public function delete(Category $category)
    {
        $this->deleteAction->handle($category);

        return $this->redirectToRoute('categories_list');
    }
}
