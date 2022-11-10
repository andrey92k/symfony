<?php

namespace App\Actions\Comments;

use App\Entity\Movie;
use App\Helper\RedisHelper;
use App\Repository\CategoryRepository;

/**
 * Class StoreAction
 * @package App\Actions\Categories
 */
class StoreAction
{
    public function __construct(
        protected RedisHelper $redisHelper
    )
    {
    }

    public function handle(array $data, $user, $ttl = null): void
    {
        $comments[] = [
            'comment' => $data['comment'],
            'user'    => $user->getUsername() ?? $user->getEmail(),
        ];
        $key = $this->redisHelper->parseKey($data['movie_id'],  Movie::TYPE);
        $items =  json_decode($this->redisHelper->get($key), true);

        if ($items) {
            $comments = array_merge($items, $comments);
        }

        $this->redisHelper->set($key, json_encode($comments), $ttl);
    }
}
