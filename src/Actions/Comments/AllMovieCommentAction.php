<?php

namespace App\Actions\Comments;

use App\Entity\Movie;
use App\Helper\RedisHelper;

/**
 * Class StoreAction
 * @package App\Actions\Categories
 */
class AllMovieCommentAction
{
    public function __construct(
        protected RedisHelper $redisHelper
    )
    {
    }

    public function handle($id)
    {
        $key = $this->redisHelper->parseKey($id,  Movie::TYPE);
        $items = json_decode($this->redisHelper->get($key), true);

        return $items;
    }
}
