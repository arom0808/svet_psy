<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
    if (Article::where('id', $id)->exists()) {
        return view('article', ['article' => Article::where('id', $id)->get()]);
    } else {
        return view('errors/404');
    }
})->whereNumber('id')->name("article");

Route::get('/articles/search/{searchExpression}', function ($searchExpression) {
    return view('articles', ['searchExpression' => $searchExpression]);
})->name("articles_search");

Route::view('/about-me', 'about-me')->name("about-me");

Route::get('/admin', function () {
    return ((Auth::user()->is_admin === 1) ? view('admin') : redirect('/'));
})->name('admin')->middleware('auth');

Route::get('/admin/users', function () {
    $search_expression = request()->input('search');
    if (is_null($search_expression)) {
        $search_expression = "";
    }
    $page_index = request()->input('page');
    if (is_null($page_index) || !is_numeric($page_index)) {
        $page_index = 1;
    }
    $pages_count = DB::table('users');
    if ($search_expression != "") {
        $pages_count = $pages_count->where('name', 'like', '%'.$search_expression.'%')->orWhere('email', 'like', '%'.$search_expression.'%');
    }
    $pages_count = $pages_count->count();
    if ($pages_count % 5 != 0) {
        $pages_count += 5 - $pages_count % 5;
    }
    Log::info($pages_count);
    $pages_count /= 5;
    if ($page_index < 1 || $page_index > $pages_count) {
        return view('errors.404');
    }
    $users = DB::table('users')->orderBy('id')->select('id', 'name', 'email', 'is_admin', 'created_at')->offset($page_index * 5 - 5)->limit(5);
    if ($search_expression != "") {
        $users = $users->where('name', 'like', '%'.$search_expression.'%')->orWhere('email', 'like', '%'.$search_expression.'%');
    }
    $users = $users->get();
    return ((Auth::user()->is_admin === 1) ? view('admin_users', ['users' => $users, 'pages_count' => $pages_count, 'search_expression' => $search_expression, 'page_index' => $page_index]) : redirect('/'));
})->name('admin_users')->middleware('auth');

Route::get('/admin/users/{id}', function ($id) {
    return ((Auth::user()->is_admin === 1) ? (User::where('id', $id)->exists() ? view('admin_user', ['id' => $id]) : view('errors/404')) : redirect('/'));
})->name('admin_user')->middleware('auth');

Route::get('/admin/quotes', function () {
    return ((Auth::user()->is_admin === 1) ? view('admin_quotes') : redirect('/'));
})->name('admin_quotes')->middleware('auth');

Route::get('/admin/articles', function () {
    return ((Auth::user()->is_admin === 1) ? view('admin_articles') : redirect('/'));
})->name('admin_articles')->middleware('auth');


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
