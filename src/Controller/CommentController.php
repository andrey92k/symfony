<?php

namespace App\Controller;

use App\Actions\Comments\StoreAction;
use App\Entity\Movie;
use App\Helper\RedisHelper;
use App\Security\EmailVerifier;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use App\Resource\UserResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AllController
 *
 * @package App\Controller\Users
 */
class CommentController extends AbstractController
{
    public function __construct(
        protected StoreAction $storeAction
    )
    {
    }

    public function store($id, Request $request)
    {
        $data = $request->request->all()['comment_form'];
        $data['movie_id'] = $id;
        $user = $this->getUser();

        if (isset($user)) {
            $this->storeAction->handle($data, $user);
        }

        return $this->redirectToRoute('movie_show', ['id' => $id]);
    }
}
