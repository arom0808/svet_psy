<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    function show ($id) {
        $article = Article::find($id);
        if (!$article) {
            return view('errors/404');
        }
        return view('article', ['article' => $article]);
    }
    function search ($searchExpression) {
        return view('articles', ['searchExpression' => $searchExpression]);
    }
}
