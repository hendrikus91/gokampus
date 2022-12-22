<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\Article;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $articles = Article::with('user')->paginate(10);

        return view('article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        try {

            $data = $request->all();

            $data['article_creator'] = auth()->user()->id;

            if(request()->hasFile('article_image')) {

                $request->file('article_image')->store('public');

                $data['article_image'] = $request->file('article_image')->hashName();
            }

            Article::create($data);

            return redirect()->route('article.index')->with('success', 'Article has been created');
            
        } catch (Exception $e) {

            Log::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('article.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        try {

            $data = $request->all();

            if($request->hasFile('article_image')) {

                Storage::disk('public')->delete($article->article_image);

                $request->file('article_image')->store('public');

                $data['article_image'] = $request->file('article_image')->hashName();
            }

            $article->update($data);

            return redirect()->route('article.index')->with('success', 'Article has been updated');
            
        } catch (Exception $e) {

            Log::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try {


            Storage::disk('public')->delete($article->article_image);

            $article->delete();

            return redirect()->route('article.index')->with('success', 'Article has been deleted');
            
        } catch (Exception $e) {

            Log::error($e->getMessage());
        }
    }
}
