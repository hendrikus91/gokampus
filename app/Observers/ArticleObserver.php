<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function created(Article $article)
    {

        Cache::put('article', [
            'title' => $article->title,
            'content' => $article->content,
            'image' => $article->article_image
        ]);
    }

    public function updated(Article $article)
    {
        Cache::put('article', [
            'title' => $article->title,
            'content' => $article->content,
            'image' => $article->article_image
        ]);
    }

}
