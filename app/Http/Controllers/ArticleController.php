<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', ['articles' => $articles]);
    }
    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show', ['article' => $article]);
    }
    public function create()
    {
        return view('articles.create');
    }
    public function store(ArticleRequest $request)
    {
        //インスタンスの作成
        $article = new Article;

        $article->title = $request->title;
        $article->body = $request->body;

        $article->save();

        return redirect(route('articles.index'));
    }

    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit', ['article' => $article]);
    }

    public function update(ArticleRequest $request, $id)
    {
        //インスタンスの作成
        $article = Article::find($id);

        $article->title = $request->title;
        $article->body = $request->body;

        $article->save();

        return redirect(route('articles.index'));
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect(route("articles.index"));
    }
}
