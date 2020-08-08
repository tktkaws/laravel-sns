<?php

namespace App\Http\Controllers;

//==========ここから追加==========
use App\Article;
//==========ここまで追加==========

use Illuminate\Http\Request;

class ArticleController extends Controller
{

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
}
