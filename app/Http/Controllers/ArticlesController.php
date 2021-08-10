<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    function show($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return view('errors/404');
        }
        $html = Storage::disk('public')->get($article->html_file_path);
        return view('article', ['article' => $article, 'html' => $html]);
    }
    function search($searchExpression)
    {
        return view('articles', ['searchExpression' => $searchExpression]);
    }
}
