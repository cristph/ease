<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Request;
//use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Article;

class ArticlesController extends Controller
{
    public function index(){
        $articles = Article::latest('published_at')->published()->get();
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article){
        return view('articles.show', compact('article'));
    }

    public function create(){
        return view('articles.create');
    }

    public function store(ArticleRequest $request){
//        $input = Request::all();
//        $input['published_at'] = Carbon::now();
//        Article::create($input);
//        return redirect('articles');
        Article::create($request->all());
        return redirect('articles');
    }

    public function edit(Article $article){
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article, ArticleRequest $request){
        $article->update($request->all());
        return redirect('articles');
    }
}
