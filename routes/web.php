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

    Route::get('/admin/articles', [AdminController::class, "articles"])->name('admin_articles');

    Route::view('/admin/articles/new', "admin_new_article")->name('admin_new_article');

    Route::post('/admin/articles/new', [AdminController::class, "newArticlePOST"])->name('admin_new_article_post');

    Route::get('/admin/articles/{id}', [AdminController::class, "article"])->whereNumber('id')->name('admin_article');

    Route::post('/admin/articles/{id}', [AdminController::class, "articlePOST"])->whereNumber('id')->name("admin_article_post");

    Route::post('/admin/articles/delete/{id}', [AdminController::class, "articleDelete"])->whereNumber('id')->name('admin_article_delete');

    Route::get('/admin/quotes', [AdminController::class, "quotes"])->name('admin_quotes');

    Route::view('/admin/quotes/new', "admin_new_quote")->name('admin_new_quote');

    Route::post('/admin/quotes/new', [AdminController::class, "newQuotePOST"])->name('admin_new_quote_post');

    Route::get('/admin/quotes/{id}', [AdminController::class, "quote"])->whereNumber('id')->name('admin_quote');

    Route::post('/admin/quotes/{id}', [AdminController::class, "quotePOST"])->whereNumber('id')->name("admin_quote_post");

    Route::post('/admin/quotes/delete/{id}', [AdminController::class, "quoteDelete"])->whereNumber('id')->name('admin_quote_delete');
});

