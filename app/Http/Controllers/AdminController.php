<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    function users(Request $request)
    {
        $search_expression = $request->input('search');
        $search_expression = !is_null($search_expression) ? $search_expression : "";
        $page_index = $request->input('page');
        $page_index = !is_null($search_expression) && is_numeric($page_index) ? $page_index : 1;
        $pages_count = DB::table('users');
        if ($search_expression != "") {
            $pages_count = $pages_count->where('name', 'like', '%' . $search_expression . '%')
                ->orWhere('email', 'like', '%' . $search_expression . '%');
        }
        $pages_count = $pages_count->count();
        $pages_count += $pages_count % 5 === 0 ? 0 : 5 - $pages_count % 5;
        $pages_count /= 5;
        $users = User::orderBy('id')->offset($page_index * 5 - 5)->limit(5);
        if ($search_expression != "") {
            $users = $users->where('name', 'like', '%' . $search_expression . '%')->orWhere('email', 'like', '%' . $search_expression . '%');
        }
        $users = $users->get();
        return view('admin_users', ['users' => $users, 'pages_count' => $pages_count, 'search_expression' => $search_expression, 'page_index' => $page_index]);
    }

    function articles(Request $request)
    {
        $search_expression = $request->input('search');
        $search_expression = !is_null($search_expression) ? $search_expression : "";
        $page_index = $request->input('page');
        $page_index = !is_null($search_expression) && is_numeric($page_index) ? $page_index : 1;
        $pages_count = DB::table('articles');
        if ($search_expression != "") {
            $pages_count = $pages_count->where('category', 'like', '%' . $search_expression . '%')
                ->orWhere('title', 'like', '%' . $search_expression . '%')->orWhere('short_description', 'like', '%' . $search_expression . '%');
        }
        $pages_count = $pages_count->count();
        $pages_count += $pages_count % 5 === 0 ? 0 : 5 - $pages_count % 5;
        $pages_count /= 5;
        $articles = Article::orderBy('id')->offset($page_index * 5 - 5)->limit(5);
        if ($search_expression != "") {
            $articles = $articles->where('category', 'like', '%' . $search_expression . '%')
                ->orWhere('title', 'like', '%' . $search_expression . '%')->orWhere('short_description', 'like', '%' . $search_expression . '%');
        }
        $articles = $articles->get();
        return view('admin_articles', ['articles' => $articles, 'pages_count' => $pages_count, 'search_expression' => $search_expression, 'page_index' => $page_index]);
    }

    function newArticlePOST(Request $request)
    {
        $preview_photo_path = $request->file('preview_file')->store('articles/preview_photos', 'public');
        $category = $request->input('category');
        $title = $request->input('title');
        $short_description = $request->input('short_description');
        $publisher_id = $request->input('publisher_id');
        $time_to_read = $request->input('time_to_read');
        $html = $request->input('html');
        $html_file_path = 'articles/html_files/' . uniqid('article_html') . md5($html) . '.html';
        Storage::disk('public')->put($html_file_path, $html);
        Article::create([
            'preview_photo_path' => $preview_photo_path, 'category' => $category, 'title' => $title, 'short_description' => $short_description,
            'publisher_id' => $publisher_id, 'time_to_read' => $time_to_read, 'html_file_path' => $html_file_path
        ]);
        // return view('admin_new_article');
        return redirect($request->input('callback'));
    }

    function article($id)
    {
        $article = Article::where('id', $id)->first();
        $html = Storage::disk('public')->get($article->html_file_path);
        return view('admin_article', ['article' => $article, 'html' => $html]);
    }


    function articlePOST(Request $request, $id)
    {
        $article = Article::where('id', $id)->first();
        $preview_photo_path = $article->preview_photo_path;
        Log::info(asset($preview_photo_path));
        // if ($request->file('preview_file')) {
        //     $preview_photo_path = $request->file('preview_file')->storeAs('articles/preview_photos', '', 'public');
        // }
        // $category = $request->input('category');
        // $title = $request->input('title');
        // $short_description = $request->input('short_description');
        // $publisher_id = $request->input('publisher_id');
        // $time_to_read = $request->input('time_to_read');
        $html = $request->input('html');
        // $html_file_path = Article::where('id', $id)->html_file_path;
        // Storage::disk('public')->put($html_file_path, $html);
        return view('admin_article', ['article' => $article, 'html' => $html]);
        // return redirect($request->input('callback'));
    }

    // function articleChange(Request $request, $id)
    // {
    //     $request->file('preview_file')->store('public/files');
    //     // $request->file('preview_file')->store(Article::select('preview_photo_path')->where('id, $id')->first()->preview_photo_path);
    //     return redirect($request->input('callback'));
    // }
}
