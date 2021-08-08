<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticlesController;

Route::view('/', 'home')->name("home");

Route::view('/quotes', 'quotes')->name("quotes");

Route::get('/quotes/search/{searchExpression}', [QuotesController::class, "search"])->name("quotes_search");

Route::view('/articles', 'articles')->name("articles");

Route::get('/articles/{id}', [ArticlesController::class, "show"])->whereNumber('id')->name("article");

Route::get('/articles/search/{searchExpression}', [ArticlesController::class, "search"])->name("articles_search");

Route::view('/about-me', 'about-me')->name("about-me");

Route::middleware('admin')->group(function () {
    Route::view('/admin', 'admin')->name('admin');

    Route::get('/admin/users', [AdminController::class, "users"])->name('admin_users');

    Route::view('/admin/quotes', 'admin_quotes')->name('admin_quotes');

    Route::get('/admin/articles', [AdminController::class, "articles"])->name('admin_articles');

    Route::view('/admin/articles/new', "admin_new_article")->name('admin_new_article');

    Route::post('/admin/articles/new', [AdminController::class, "newArticlePOST"])->name('admin_new_article_post');

    Route::get('/admin/article/{id}', [AdminController::class, "article"])->name('admin_article');

    Route::post('/admin/article/{id}', [AdminController::class, "articlePOST"])->name("admin_article_post");
});

