<?php

namespace App\Http\Controllers\Api;


use App\Models\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::paginate(10);

        if($articles->isNotEmpty()) {

            return response()->json([
                'code' => 200,
                'data' => $articles->map(function($article) {

                    return [
                        'title' => $article->title,
                        'creator' => $article->user->name ?? '',
                        'content' => $article->content,
                        'image' => asset('storage/'. $article->article_image)   
                    ];
                }),

                'pagination' => [
                    'current_page' => $articles->currentPage(),
                    'next_page_url' => $articles->nextPageUrl(),
                    'per_page' => $articles->perPage(),
                    'prev_page_url' => $articles->previousPageUrl()
                ]
            ], 200);
                        
        }

        return response()->json([
            'code' => 200,
            'data' => [],
            'pagination' => []
        ], 200);
    }
    
}
