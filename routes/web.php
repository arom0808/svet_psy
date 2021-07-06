<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/quotes/{searchExpression}', function ($searchExpression) {
    return view('quotes', ['searchExpression' => $searchExpression]);
})->name("quotes_search");

Route::view('/articles', 'articles')->name("articles");

Route::view('/about-me', 'about-me')->name("about-me");
