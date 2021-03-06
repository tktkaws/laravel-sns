<?php

namespace App\Http\Controllers;

//==========ここから追加==========
use App\Article;
//==========ここまで追加==========
//===========ここから追加==========
use App\Http\Requests\ArticleRequest;
//===========ここまで追加==========

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    //==========ここから追加==========
    public function index()
    {
         //==========ここから追加==========
         $articles = Article::all()->sortByDesc('created_at');
         //==========ここまで追加==========

        return view('articles.index', ['articles' => $articles]);
    }
    //==========ここまで追加==========

    //==========ここから追加==========
    public function create()
    {
        return view('articles.create');
    }
    //==========ここまで追加==========

     //==========ここから追加==========
     public function store(ArticleRequest $request, Article $article)
     {
         $article->fill($request->all()); //-- この行を追加
         $article->user_id = $request->user()->id;
         $article->save();
         return redirect()->route('articles.index');
     }
     //==========ここまで追加==========
    //==========ここから追加==========
    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }
    //==========ここまで追加==========
    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();
        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }

    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }


}
