<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Article;
use App\Models\Quote;
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
        $page_number = $page_index;
        $pages_arr = [];
        if ($pages_count <= 7) {
            for ($i = 1; $i <= $pages_count; ++$i) {
                $pages_arr[$i - 1] = $i === $page_number ? '.' . strval($i) : strval($i);
            }
        } else {
            $pages_arr = ['1', '', '', '', '', '', strval($pages_count)];
            $current_page_array_index = 0;
            if ($page_number <= 3) {
                $current_page_array_index = $page_number - 1;
            } elseif ($page_number >= $pages_count - 2) {
                $current_page_array_index = $page_number - $pages_count - 1 + 7;
            } else {
                $current_page_array_index = 3;
            }
            if ($current_page_array_index === 0) {
                $pages_arr = ['.1', '2', '3', '...', strval($pages_count - 2), strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 1) {
                $pages_arr = ['1', '.2', '3', '4', '...', strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 2) {
                $pages_arr = ['1', '2', '.3', '4', '5', '...', strval($pages_count)];
            }
            if ($current_page_array_index === 3) {
                $pages_arr = ['1', '...', strval($page_number - 1), '.' . strval($page_number), strval($page_number + 1), '...', strval($pages_count)];
            }
            if ($current_page_array_index === 4) {
                $pages_arr = ['1', '...', strval($pages_count - 4), strval($pages_count - 3), '.' . strval($pages_count - 2), strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 5) {
                $pages_arr = ['1', '2', '...', strval($pages_count - 3), strval($pages_count - 2), '.' . strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 6) {
                $pages_arr = ['1', '2', '3', '...', strval($pages_count - 2), strval($pages_count - 1), '.' . strval($pages_count)];
            }
        }
        return view('admin_users', ['users' => $users, 'pages_count' => $pages_count, 'search_expression' => $search_expression, 'page_index' => $page_index, 'page_number' => $page_number, 'pages_arr' => $pages_arr]);
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
        $page_number = $page_index;
        $pages_arr = [];
        if ($pages_count <= 7) {
            for ($i = 1; $i <= $pages_count; ++$i) {
                $pages_arr[$i - 1] = $i === $page_number ? '.' . strval($i) : strval($i);
            }
        } else {
            $pages_arr = ['1', '', '', '', '', '', strval($pages_count)];
            $current_page_array_index = 0;
            if ($page_number <= 3) {
                $current_page_array_index = $page_number - 1;
            } elseif ($page_number >= $pages_count - 2) {
                $current_page_array_index = $page_number - $pages_count - 1 + 7;
            } else {
                $current_page_array_index = 3;
            }
            if ($current_page_array_index === 0) {
                $pages_arr = ['.1', '2', '3', '...', strval($pages_count - 2), strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 1) {
                $pages_arr = ['1', '.2', '3', '4', '...', strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 2) {
                $pages_arr = ['1', '2', '.3', '4', '5', '...', strval($pages_count)];
            }
            if ($current_page_array_index === 3) {
                $pages_arr = ['1', '...', strval($page_number - 1), '.' . strval($page_number), strval($page_number + 1), '...', strval($pages_count)];
            }
            if ($current_page_array_index === 4) {
                $pages_arr = ['1', '...', strval($pages_count - 4), strval($pages_count - 3), '.' . strval($pages_count - 2), strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 5) {
                $pages_arr = ['1', '2', '...', strval($pages_count - 3), strval($pages_count - 2), '.' . strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 6) {
                $pages_arr = ['1', '2', '3', '...', strval($pages_count - 2), strval($pages_count - 1), '.' . strval($pages_count)];
            }
        }
        return view('admin_articles', ['articles' => $articles, 'pages_count' => $pages_count, 'search_expression' => $search_expression, 'page_index' => $page_index, 'page_number' => $page_number, 'pages_arr' => $pages_arr]);
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
        $article = Article::find($id);
        if (!$article) {
            return view('errors/404');
        }
        $html = Storage::disk('public')->get($article->html_file_path);
        return view('admin_article', ['article' => $article, 'html' => $html]);
    }

    function articlePOST(Request $request, $id)
    {
        $article = Article::find($id);
        $preview_photo_path = $article->preview_photo_path;
        if ($request->file('preview_file')) {
            Storage::delete([$preview_photo_path]);
            $preview_photo_path = $request->file('preview_file')->store('articles/preview_photos', 'public');
        }
        $category = $request->input('category');
        $title = $request->input('title');
        $short_description = $request->input('short_description');
        $time_to_read = $request->input('time_to_read');
        $html = $request->input('html');
        $html_file_path = $article->html_file_path;
        Storage::disk('public')->put($html_file_path, $html);
        $article->update(
            [
                'preview_photo_path' => $preview_photo_path,
                'category' => $category,
                'title' => $title,
                'short_description' => $short_description,
                'time_to_read' => $time_to_read
            ]
        );
        return redirect($request->input('callback'));
    }

    function articleDelete(Request $request, $id)
    {
        $article = Article::find($id);
        Storage::disk('public')->delete([$article->preview_photo_path, $article->html_file_path]);
        $article->delete();
        return redirect($request->input('callback'));
    }

    function quotes(Request $request)
    {
        $search_expression = $request->input('search');
        $search_expression = !is_null($search_expression) ? $search_expression : "";
        $page_index = $request->input('page');
        $page_index = !is_null($search_expression) && is_numeric($page_index) ? $page_index : 1;
        $pages_count = DB::table('quotes');
        if ($search_expression != "") {
            $pages_count = $pages_count->where('category', 'like', '%' . $search_expression . '%')
                ->orWhere('text', 'like', '%' . $search_expression . '%')->orWhere('author', 'like', '%' . $search_expression . '%');
        }
        $pages_count = $pages_count->count();
        $pages_count += $pages_count % 5 === 0 ? 0 : 5 - $pages_count % 5;
        $pages_count /= 5;
        $quotes = Quote::orderBy('id')->offset($page_index * 5 - 5)->limit(5);
        if ($search_expression != "") {
            $quotes = $quotes->where('category', 'like', '%' . $search_expression . '%')
                ->orWhere('text', 'like', '%' . $search_expression . '%')->orWhere('author', 'like', '%' . $search_expression . '%');
        }
        $quotes = $quotes->get();
        $page_number = $page_index;
        $pages_arr = [];
        if ($pages_count <= 7) {
            for ($i = 1; $i <= $pages_count; ++$i) {
                $pages_arr[$i - 1] = $i === $page_number ? '.' . strval($i) : strval($i);
            }
        } else {
            $pages_arr = ['1', '', '', '', '', '', strval($pages_count)];
            $current_page_array_index = 0;
            if ($page_number <= 3) {
                $current_page_array_index = $page_number - 1;
            } elseif ($page_number >= $pages_count - 2) {
                $current_page_array_index = $page_number - $pages_count - 1 + 7;
            } else {
                $current_page_array_index = 3;
            }
            if ($current_page_array_index === 0) {
                $pages_arr = ['.1', '2', '3', '...', strval($pages_count - 2), strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 1) {
                $pages_arr = ['1', '.2', '3', '4', '...', strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 2) {
                $pages_arr = ['1', '2', '.3', '4', '5', '...', strval($pages_count)];
            }
            if ($current_page_array_index === 3) {
                $pages_arr = ['1', '...', strval($page_number - 1), '.' . strval($page_number), strval($page_number + 1), '...', strval($pages_count)];
            }
            if ($current_page_array_index === 4) {
                $pages_arr = ['1', '...', strval($pages_count - 4), strval($pages_count - 3), '.' . strval($pages_count - 2), strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 5) {
                $pages_arr = ['1', '2', '...', strval($pages_count - 3), strval($pages_count - 2), '.' . strval($pages_count - 1), strval($pages_count)];
            }
            if ($current_page_array_index === 6) {
                $pages_arr = ['1', '2', '3', '...', strval($pages_count - 2), strval($pages_count - 1), '.' . strval($pages_count)];
            }
        }
        return view('admin_quotes', ['quotes' => $quotes, 'pages_count' => $pages_count, 'search_expression' => $search_expression, 'page_index' => $page_index, 'page_number' => $page_number, 'pages_arr' => $pages_arr]);
    }

    function newQuotePOST(Request $request)
    {
        $text = $request->input('text');
        $category = $request->input('category');
        $author = $request->input('author');
        $publisher_id = $request->input('publisher_id');
        Quote::create([
            'text' => $text, 'publisher_id' => $publisher_id, 'category' => $category, 'author' => $author
        ]);
        return redirect($request->input('callback'));
    }

    function quote($id)
    {
        $quote = Quote::find($id);
        if (!$quote) {
            return view('errors/404');
        }
        return view('admin_quote', ['quote' => $quote]);
    }

    function quotePOST(Request $request, $id)
    {
        $quote = Quote::find($id);
        $text = $request->input('text');
        $category = $request->input('category');
        $author = $request->input('author');
        $quote->update(
            [
                'text' => $text,
                'category' => $category,
                'author' => $author
            ]
        );
        return redirect($request->input('callback'));
    }

    function quoteDelete(Request $request, $id)
    {
        Quote::find($id)->delete();
        return redirect($request->input('callback'));
    }
}
