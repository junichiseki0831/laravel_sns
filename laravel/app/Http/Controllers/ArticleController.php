<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index() {
        // ダミーデータ
        // $articles = [
        //     (object) [
        //         'id' => 1,
        //         'title' => 'タイトル1',
        //         'body' => '本文1',
        //         'created_at' => now(),
        //         'user' => (object) [
        //             'id' => 1,
        //             'name' => 'ユーザー名1',
        //         ],
        //     ],
        //     (object) [
        //         'id' => 2,
        //         'title' => 'タイトル2',
        //         'body' => '本文2',
        //         'created_at' => now(),
        //         'user' => (object) [
        //             'id' => 2,
        //             'name' => 'ユーザー名2',
        //         ],
        //     ],
        //     (object) [
        //         'id' => 3,
        //         'title' => 'タイトル3',
        //         'body' => '本文3',
        //         'created_at' => now(),
        //         'user' => (object) [
        //             'id' => 3,
        //             'name' => 'ユーザー名3',
        //         ],
        //     ],
        // ];

    $articles = Article::all()->sortByDesc('created_at');

    return view('articles.index', compact('articles'));

    }

    public function create()
    {
        return view('articles.create');    
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save();
        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);    
    }

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
}
