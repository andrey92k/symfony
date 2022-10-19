<?php

namespace App\Actions\Users;

use App\Entity\User;
use App\Repository\UserRepository;

/**
 * Class DeleteAction
 * @package App\Actions\Users
 */
class DeleteAction
{
    public function __construct(
        protected UserRepository $userRepository,
    )
    {
    }

    public function handle(User $user): void
    {
        $this->userRepository->remove($user, true);
    }
}
