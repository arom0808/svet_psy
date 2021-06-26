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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/quotes', function () {
    return view('quotes');
})->name('quotes');

Route::get('/articles', function () {
    return view('articles');
})->name('articles');

Route::get('/about-me', function () {
    return view('about-me');
})->name('about-me');
