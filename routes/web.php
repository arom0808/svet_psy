<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home')->name("home");

Route::view('/quotes', 'quotes')->name("quotes");

Route::get('/quotes/search/{searchExpression}', function ($searchExpression) {
    return view('quotes', ['searchExpression' => $searchExpression]);
})->name("quotes_search");

Route::view('/articles', 'articles')->name("articles");

Route::get('/articles/{id}', function ($id) {
    if(Article::where('id', $id)->exists()) { return view('article', ['article' => Article::where('id', $id)->get()]); }
    else { return view('errors/404'); }
})->whereNumber('id')->name("article");

Route::get('/articles/search/{searchExpression}', function ($searchExpression) {
    return view('articles', ['searchExpression' => $searchExpression]);
})->name("articles_search");

Route::get('/admin', function () {
    Log::info(Auth::user());
    return view('admin');
})->name('admin')->middleware('auth');

Route::view('/about-me', 'about-me')->name("about-me");
