<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/quotes/categories', 'quotes-categories')->name("quotes-categories");

Route::get('/quotes/categories/{categoryId}', function ($categoryId) {
    return view('quotes-category', ['categoryId'=>$categoryId]);
})->name("quotes-category");

Route::view('/articles', 'articles')->name("articles");

Route::view('/about-me', 'about-me')->name("about-me");
