<?php

namespace App\Repositories\Eloquents;

use App\Models\Article;
use App\Repositories\Contracts\ArticleInterface;

class ArticleRepository extends BaseRepository implements ArticleInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Article';
    }
}
